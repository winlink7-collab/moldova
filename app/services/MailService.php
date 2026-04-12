<?php
/**
 * Email Service - sends emails via SMTP using PHPMailer-lite approach
 * Uses PHP's built-in mail() or SMTP via fsockopen
 */
class MailService {
    private static $config = null;

    public static function getConfig() {
        if (self::$config === null) {
            // Load from DB settings or use defaults
            try {
                $db = Database::getInstance();
                $settings = $db->fetchAll('SELECT setting_key, setting_value FROM settings');
                $s = [];
                foreach ($settings as $row) $s[$row['setting_key']] = $row['setting_value'];
                self::$config = [
                    'from_email' => $s['site_email'] ?? 'noreply@moldova-ukraine-brides.com',
                    'from_name' => $s['site_name'] ?? 'Moldova & Ukraine Luxury Brides',
                    'site_url' => 'https://' . ($_SERVER['HTTP_HOST'] ?? 'phpstack-679104-6338346.cloudwaysapps.com'),
                    'site_phone' => $s['site_phone'] ?? '',
                ];
            } catch (Exception $e) {
                self::$config = [
                    'from_email' => 'noreply@moldova-ukraine-brides.com',
                    'from_name' => 'Moldova & Ukraine Luxury Brides',
                    'site_url' => 'https://' . ($_SERVER['HTTP_HOST'] ?? ''),
                    'site_phone' => '',
                ];
            }
        }
        return self::$config;
    }

    /**
     * Send an email
     */
    public static function send($to, $subject, $htmlBody, $textBody = '') {
        $config = self::getConfig();

        // Try SendGrid first if API key configured
        $apiKey = defined('SENDGRID_API_KEY') ? SENDGRID_API_KEY : '';
        if (!$apiKey) {
            // Load from config file
            $configFile = BASE_PATH . '/config/mail.php';
            if (file_exists($configFile)) {
                require_once $configFile;
                $apiKey = defined('SENDGRID_API_KEY') ? SENDGRID_API_KEY : '';
            }
        }

        if ($apiKey) {
            $result = self::sendViaSendGrid($apiKey, $to, $subject, $htmlBody);
        } else {
            // Fallback to PHP mail()
            $from = $config['from_email'];
            $fromName = $config['from_name'];
            $headers = [
                'MIME-Version: 1.0',
                'Content-Type: text/html; charset=UTF-8',
                'From: ' . $fromName . ' <' . $from . '>',
                'Reply-To: ' . $from,
                'X-Mailer: PHP/' . phpversion(),
            ];
            $result = @mail($to, $subject, $htmlBody, implode("\r\n", $headers));
        }

        self::log($to, $subject, $result);
        return $result;
    }

    /**
     * Send email via SendGrid API
     */
    private static function sendViaSendGrid($apiKey, $to, $subject, $htmlBody) {
        $config = self::getConfig();
        $fromEmail = defined('SENDGRID_FROM_EMAIL') ? SENDGRID_FROM_EMAIL : $config['from_email'];
        $fromName = $config['from_name'];

        $payload = [
            'personalizations' => [[
                'to' => [['email' => $to]]
            ]],
            'from' => ['email' => $fromEmail, 'name' => $fromName],
            'subject' => $subject,
            'content' => [[
                'type' => 'text/html',
                'value' => $htmlBody
            ]]
        ];

        $ch = curl_init('https://api.sendgrid.com/v3/mail/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // Log response for debugging
        @file_put_contents(BASE_PATH . '/uploads/email_log.txt',
            date('Y-m-d H:i:s') . " | SendGrid HTTP:$httpCode | To:$to | Response:$response | Error:$error\n",
            FILE_APPEND);

        return $httpCode >= 200 && $httpCode < 300;
    }

    /**
     * Send email verification after registration
     */
    public static function sendVerificationEmail($user, $token) {
        $config = self::getConfig();
        $name = htmlspecialchars($user['name']);
        $siteUrl = $config['site_url'];
        $siteName = $config['from_name'];
        $verifyUrl = $siteUrl . '/api/verify-email?token=' . $token;

        $subject = "אימות כתובת מייל | Verify Your Email - $siteName";

        $html = self::getTemplate('verify', [
            'name' => $name,
            'verify_url' => $verifyUrl,
            'site_url' => $siteUrl,
            'site_name' => $siteName,
        ]);

        return self::send($user['email'], $subject, $html);
    }

    /**
     * Send welcome email after registration
     */
    public static function sendWelcomeEmail($user) {
        $config = self::getConfig();
        $name = htmlspecialchars($user['name']);
        $siteUrl = $config['site_url'];
        $siteName = $config['from_name'];

        $subject = "ברוכים הבאים ל-$siteName! | Welcome!";

        $html = self::getTemplate('welcome', [
            'name' => $name,
            'email' => $user['email'],
            'site_url' => $siteUrl,
            'site_name' => $siteName,
            'login_url' => $siteUrl . '/login',
        ]);

        return self::send($user['email'], $subject, $html);
    }

    /**
     * Send password reset email
     */
    public static function sendPasswordResetEmail($email, $token) {
        $config = self::getConfig();
        $siteUrl = $config['site_url'];
        $siteName = $config['from_name'];
        $resetUrl = $siteUrl . '/login?reset=' . $token;

        $subject = "איפוס סיסמה | Password Reset - $siteName";

        $html = self::getTemplate('reset', [
            'reset_url' => $resetUrl,
            'site_url' => $siteUrl,
            'site_name' => $siteName,
            'token' => $token,
        ]);

        return self::send($email, $subject, $html);
    }

    /**
     * Send notification to admin about new registration
     */
    public static function sendAdminNotification($type, $data) {
        $config = self::getConfig();
        $adminEmail = $config['from_email'];

        switch ($type) {
            case 'new_user':
                $subject = "משתמש חדש נרשם: " . ($data['name'] ?? '');
                $html = "<div style='font-family:Arial;direction:rtl;'>"
                    . "<h2>משתמש חדש נרשם לאתר</h2>"
                    . "<p><strong>שם:</strong> " . htmlspecialchars($data['name'] ?? '') . "</p>"
                    . "<p><strong>אימייל:</strong> " . htmlspecialchars($data['email'] ?? '') . "</p>"
                    . "<p><strong>טלפון:</strong> " . htmlspecialchars($data['phone'] ?? '') . "</p>"
                    . "<p><strong>תאריך:</strong> " . date('d/m/Y H:i') . "</p>"
                    . "</div>";
                break;

            case 'new_lead':
                $subject = "ליד חדש: " . ($data['name'] ?? '');
                $html = "<div style='font-family:Arial;direction:rtl;'>"
                    . "<h2>ליד חדש התקבל</h2>"
                    . "<p><strong>שם:</strong> " . htmlspecialchars($data['name'] ?? '') . "</p>"
                    . "<p><strong>אימייל:</strong> " . htmlspecialchars($data['email'] ?? '') . "</p>"
                    . "<p><strong>טלפון:</strong> " . htmlspecialchars($data['phone'] ?? '') . "</p>"
                    . "<p><strong>הודעה:</strong> " . htmlspecialchars($data['message'] ?? '') . "</p>"
                    . "</div>";
                break;

            case 'new_message':
                $subject = "הודעה חדשה מ: " . ($data['sender_name'] ?? '');
                $html = "<div style='font-family:Arial;direction:rtl;'>"
                    . "<h2>הודעה חדשה התקבלה</h2>"
                    . "<p><strong>שולח:</strong> " . htmlspecialchars($data['sender_name'] ?? '') . "</p>"
                    . "<p><strong>אימייל:</strong> " . htmlspecialchars($data['sender_email'] ?? '') . "</p>"
                    . "<p><strong>הודעה:</strong> " . htmlspecialchars($data['message'] ?? '') . "</p>"
                    . "</div>";
                break;

            default:
                return false;
        }

        return self::send($adminEmail, $subject, $html);
    }

    /**
     * Get email template
     */
    private static function getTemplate($name, $vars) {
        $config = self::getConfig();

        $logo = '<div style="text-align:center;padding:20px 0;"><span style="font-size:28px;font-weight:900;color:#f2d00d;">MOLDOVA & UKRAINE</span><br><span style="font-size:10px;letter-spacing:4px;color:#b89b06;">LUXURY BRIDES</span></div>';

        $footer = '<div style="text-align:center;padding:20px 0;border-top:1px solid #333;margin-top:30px;color:#888;font-size:12px;">'
            . '<p>' . $config['from_name'] . '</p>'
            . '<p><a href="' . $config['site_url'] . '" style="color:#f2d00d;">' . $config['site_url'] . '</a></p>'
            . '</div>';

        switch ($name) {
            case 'verify':
                return '<!DOCTYPE html><html dir="rtl"><head><meta charset="UTF-8"></head>'
                    . '<body style="margin:0;padding:0;background:#12110a;font-family:Arial,sans-serif;">'
                    . '<div style="max-width:600px;margin:0 auto;background:#1a1810;border:1px solid #393728;border-radius:12px;overflow:hidden;">'
                    . $logo
                    . '<div style="padding:30px 40px;color:#fff;">'
                    . '<h1 style="color:#f2d00d;font-size:24px;margin-bottom:20px;">שלום ' . $vars['name'] . '! 👋</h1>'
                    . '<p style="font-size:16px;line-height:1.8;color:#ccc;">תודה שנרשמת לשירות השידוכים היוקרתי שלנו!</p>'
                    . '<p style="font-size:16px;line-height:1.8;color:#ccc;">כדי להשלים את ההרשמה ולהתחבר, אנא אמת את כתובת המייל שלך:</p>'
                    . '<div style="text-align:center;margin:30px 0;">'
                    . '<a href="' . $vars['verify_url'] . '" style="display:inline-block;background:linear-gradient(135deg,#f2d00d,#b89b06);color:#12110a;padding:18px 50px;border-radius:12px;text-decoration:none;font-weight:900;font-size:18px;">אמת את המייל שלי ✓</a>'
                    . '</div>'
                    . '<p style="font-size:14px;color:#888;text-align:center;">או העתק את הקישור:</p>'
                    . '<p style="font-size:12px;color:#666;word-break:break-all;background:#0f0e08;padding:12px;border-radius:8px;direction:ltr;">' . $vars['verify_url'] . '</p>'
                    . '<p style="font-size:13px;color:#666;margin-top:20px;">אם לא נרשמת לאתר, התעלם מהודעה זו.</p>'
                    . '</div>'
                    . $footer
                    . '</div></body></html>';

            case 'welcome':
                return '<!DOCTYPE html><html dir="rtl"><head><meta charset="UTF-8"></head>'
                    . '<body style="margin:0;padding:0;background:#12110a;font-family:Arial,sans-serif;">'
                    . '<div style="max-width:600px;margin:0 auto;background:#1a1810;border:1px solid #393728;border-radius:12px;overflow:hidden;">'
                    . $logo
                    . '<div style="padding:30px 40px;color:#fff;">'
                    . '<h1 style="color:#f2d00d;font-size:24px;margin-bottom:20px;">שלום ' . $vars['name'] . '! 👋</h1>'
                    . '<p style="font-size:16px;line-height:1.8;color:#ccc;">ברוכים הבאים לשירות השידוכים היוקרתי שלנו. אנחנו שמחים שהצטרפת אלינו!</p>'
                    . '<p style="font-size:16px;line-height:1.8;color:#ccc;">החשבון שלך נוצר בהצלחה עם האימייל: <strong style="color:#f2d00d;">' . $vars['email'] . '</strong></p>'
                    . '<div style="text-align:center;margin:30px 0;">'
                    . '<a href="' . $vars['login_url'] . '" style="display:inline-block;background:linear-gradient(135deg,#f2d00d,#b89b06);color:#12110a;padding:15px 40px;border-radius:10px;text-decoration:none;font-weight:900;font-size:16px;">התחבר לחשבון שלך</a>'
                    . '</div>'
                    . '<p style="font-size:14px;color:#888;">אם יש לך שאלות, אל תהסס ליצור קשר.</p>'
                    . '</div>'
                    . $footer
                    . '</div></body></html>';

            case 'reset':
                return '<!DOCTYPE html><html dir="rtl"><head><meta charset="UTF-8"></head>'
                    . '<body style="margin:0;padding:0;background:#12110a;font-family:Arial,sans-serif;">'
                    . '<div style="max-width:600px;margin:0 auto;background:#1a1810;border:1px solid #393728;border-radius:12px;overflow:hidden;">'
                    . $logo
                    . '<div style="padding:30px 40px;color:#fff;">'
                    . '<h1 style="color:#f2d00d;font-size:24px;margin-bottom:20px;">איפוס סיסמה 🔐</h1>'
                    . '<p style="font-size:16px;line-height:1.8;color:#ccc;">קיבלנו בקשה לאיפוס הסיסמה שלך. לחץ על הכפתור למטה:</p>'
                    . '<div style="text-align:center;margin:30px 0;">'
                    . '<a href="' . $vars['reset_url'] . '" style="display:inline-block;background:linear-gradient(135deg,#f2d00d,#b89b06);color:#12110a;padding:15px 40px;border-radius:10px;text-decoration:none;font-weight:900;font-size:16px;">איפוס סיסמה</a>'
                    . '</div>'
                    . '<p style="font-size:14px;color:#888;">הקישור תקף לשעה אחת בלבד.</p>'
                    . '<p style="font-size:13px;color:#666;">אם לא ביקשת איפוס סיסמה, התעלם מהודעה זו.</p>'
                    . '</div>'
                    . $footer
                    . '</div></body></html>';

            default:
                return '';
        }
    }

    /**
     * Log email sending attempt
     */
    private static function log($to, $subject, $success) {
        $logFile = BASE_PATH . '/uploads/email_log.txt';
        $line = date('Y-m-d H:i:s') . ' | ' . ($success ? 'OK' : 'FAIL') . ' | To: ' . $to . ' | Subject: ' . $subject . "\n";
        @file_put_contents($logFile, $line, FILE_APPEND);
    }
}
