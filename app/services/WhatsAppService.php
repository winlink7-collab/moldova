<?php
/**
 * WhatsApp Service - sends OTP via Green-API
 * Docs: https://green-api.com/he/
 */
class WhatsAppService {

    /**
     * Get Green-API credentials
     */
    private static function getCredentials() {
        if (!defined('GREEN_API_ID_INSTANCE') && file_exists(BASE_PATH . '/config/whatsapp.local.php')) {
            require_once BASE_PATH . '/config/whatsapp.local.php';
        }
        return [
            'id_instance' => defined('GREEN_API_ID_INSTANCE') ? GREEN_API_ID_INSTANCE : '',
            'api_token' => defined('GREEN_API_TOKEN') ? GREEN_API_TOKEN : '',
        ];
    }

    /**
     * Normalize phone number to international format
     * Accepts: 0501234567, 050-123-4567, +972501234567, 972501234567
     * Returns: 972501234567
     */
    public static function normalizePhone($phone) {
        // Remove all non-digit characters
        $phone = preg_replace('/[^\d+]/', '', $phone);
        // Remove + sign
        $phone = ltrim($phone, '+');
        // If starts with 0, assume Israel and replace with 972
        if (strpos($phone, '0') === 0) {
            $phone = '972' . substr($phone, 1);
        }
        // If starts with 5 (Israeli mobile without 0), add 972
        if (strpos($phone, '5') === 0 && strlen($phone) === 9) {
            $phone = '972' . $phone;
        }
        return $phone;
    }

    /**
     * Check rate limit - max 1 OTP per minute per phone
     */
    private static function checkRateLimit($phone) {
        $db = Database::getInstance();
        $recent = $db->fetchOne(
            "SELECT id FROM whatsapp_otps WHERE phone = ? AND created_at > DATE_SUB(NOW(), INTERVAL 30 SECOND) ORDER BY id DESC LIMIT 1",
            [$phone]
        );
        return !$recent;
    }

    /**
     * Generate 6-digit OTP
     */
    private static function generateOtp() {
        return str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Send OTP via WhatsApp
     * @param string $phone - Phone in any format
     * @return array ['success' => bool, 'message' => string, 'otp_id' => int|null]
     */
    public static function sendOtp($phone) {
        $phone = self::normalizePhone($phone);

        if (!$phone || strlen($phone) < 10) {
            return ['success' => false, 'message' => 'מספר טלפון לא תקין'];
        }

        // Rate limit check - only block if very recent (15 sec)
        $db = Database::getInstance();
        $veryRecent = $db->fetchOne(
            "SELECT id FROM whatsapp_otps WHERE phone = ? AND created_at > DATE_SUB(NOW(), INTERVAL 15 SECOND) ORDER BY id DESC LIMIT 1",
            [$phone]
        );
        if ($veryRecent) {
            return ['success' => true, 'message' => 'קוד נשלח. בדוק את הוואטסאפ שלך'];
        }

        $creds = self::getCredentials();
        if (!$creds['id_instance'] || !$creds['api_token']) {
            return ['success' => false, 'message' => 'שירות WhatsApp לא מוגדר'];
        }

        // Generate OTP
        $otp = self::generateOtp();
        $expiresAt = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        // Build message
        $message = "🔐 קוד האימות שלך לאתר Moldova & Ukraine Luxury Brides:\n\n"
            . "*{$otp}*\n\n"
            . "הקוד תקף ל-10 דקות בלבד.\n"
            . "אם לא ביקשת קוד זה - התעלם מהודעה זו.";

        // Send via Green-API
        $chatId = $phone . '@c.us';
        $url = "https://api.green-api.com/waInstance{$creds['id_instance']}/sendMessage/{$creds['api_token']}";

        $payload = [
            'chatId' => $chatId,
            'message' => $message
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // Log
        @file_put_contents(BASE_PATH . '/uploads/whatsapp_log.txt',
            date('Y-m-d H:i:s') . " | HTTP:$httpCode | Phone:$phone | Response:$response | Error:$error\n",
            FILE_APPEND);

        if ($httpCode >= 200 && $httpCode < 300) {
            $data = json_decode($response, true);
            if (!empty($data['idMessage'])) {
                // Save OTP to DB only on success
                $otpId = $db->insert('whatsapp_otps', [
                    'phone' => $phone,
                    'code' => hash('sha256', $otp),
                    'expires_at' => $expiresAt,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                return ['success' => true, 'message' => 'קוד אימות נשלח לוואטסאפ', 'otp_id' => $otpId];
            }
        }

        return ['success' => false, 'message' => 'שגיאה בשליחת קוד. נסה שוב מאוחר יותר'];
    }

    /**
     * Verify OTP code
     * @param string $phone
     * @param string $code
     * @return bool
     */
    public static function verifyOtp($phone, $code) {
        $phone = self::normalizePhone($phone);
        $hashedCode = hash('sha256', trim($code));

        $db = Database::getInstance();
        $otp = $db->fetchOne(
            "SELECT id FROM whatsapp_otps
             WHERE phone = ? AND code = ? AND expires_at > NOW() AND used = 0
             ORDER BY id DESC LIMIT 1",
            [$phone, $hashedCode]
        );

        if (!$otp) return false;

        // Mark as used
        $db->execute('UPDATE whatsapp_otps SET used = 1 WHERE id = ?', [$otp['id']]);
        return true;
    }
}
