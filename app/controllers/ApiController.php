<?php
class ApiController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function handleRequest($segments) {
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-cache, no-store, must-revalidate, private');
        header('Pragma: no-cache');
        $method = $_SERVER['REQUEST_METHOD'];
        $action = $segments[1] ?? '';
        $subAction = $segments[2] ?? '';
        $id = $segments[3] ?? null;

        // Check admin auth for admin routes (except GET settings and POST login)
        // Note: Using cookie-based auth token since Varnish strips PHP sessions
        if (($action === 'admin' || $action === 'panel') && $subAction !== 'login' && $subAction !== 'settings') {
            $isAdmin = $this->isAdminAuthenticated();
            if (!$isAdmin) {
                http_response_code(401);
                echo json_encode(['error' => 'נדרשת הרשאת מנהל']);
                return;
            }
        }
        if (($action === 'admin' || $action === 'panel') && $subAction === 'settings' && $method === 'POST') {
            $isAdmin = $this->isAdminAuthenticated();
            if (!$isAdmin) {
                http_response_code(401);
                echo json_encode(['error' => 'נדרשת הרשאת מנהל']);
                return;
            }
        }

        // Route to handlers
        switch ($action) {
            case 'register':
                $this->register();
                break;
            case 'login':
                $this->login();
                break;
            case 'user':
                $this->handleUser($subAction, $method);
                break;
            case 'verify-email':
                $this->verifyEmail();
                break;
            case 'resend-verification':
                $this->resendVerification();
                break;
            case 'send-whatsapp-otp':
                $this->sendWhatsappOtp();
                break;
            case 'verify-whatsapp-otp':
                $this->verifyWhatsappOtp();
                break;
            case 'forgot-password':
                $this->forgotPassword();
                break;
            case 'reset-password':
                $this->resetPassword();
                break;
            case 'leads':
                if ($method === 'POST') {
                    $this->createLead();
                } else {
                    // GET leads requires admin auth
                    $isAdmin = $this->isAdminAuthenticated();
                    if (!$isAdmin) { http_response_code(401); echo json_encode(['error' => 'unauthorized']); return; }
                    $this->getLeads();
                }
                break;
            case 'contact':
                $this->contactSubmit();
                break;
            case 'profiles':
                $this->handleProfiles($subAction, $method);
                break;
            case 'stories':
                $this->getStories();
                break;
            case 'messages':
                $this->sendMessage();
                break;
            case 'process-steps':
                $this->getProcessSteps();
                break;
            case 'faqs':
                $this->getFaqs();
                break;
            case 'reviews':
                $this->getReviews();
                break;
            case 'blocks':
                $this->getPageBlocks();
                break;
            case 'upload':
                $this->upload();
                break;
            case 'admin':
            case 'panel':
                $this->handleAdmin($subAction, $id, $method);
                break;
            case 'translate':
                $this->handleTranslate();
                break;
            default:
                http_response_code(404);
                echo json_encode(['error' => 'API route not found']);
        }
    }

    // ========================
    // Translation (public read, admin write via /api/admin/translations)
    // ========================
    private function handleTranslate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->jsonResponse(['error' => 'POST only'], 405);
        }
        $data = $this->getJson();
        $lang = $data['lang'] ?? '';
        if (!in_array($lang, ['ru', 'en'], true)) {
            return $this->jsonResponse(['error' => 'invalid lang'], 400);
        }
        $svc = new TranslationService();
        if (!empty($data['texts']) && is_array($data['texts'])) {
            $texts = array_slice(array_filter(array_map('strval', $data['texts']), 'strlen'), 0, 50);
            return $this->jsonResponse(['translations' => $svc->translateMany($texts, $lang)]);
        }
        if (isset($data['text']) && is_string($data['text'])) {
            return $this->jsonResponse(['translation' => $svc->translate($data['text'], $lang)]);
        }
        return $this->jsonResponse(['error' => 'text or texts required'], 400);
    }

    // ========================
    // Helper methods
    // ========================

    private function getJson() {
        return json_decode(file_get_contents('php://input'), true) ?: [];
    }

    /** Validate admin token against DB. Caches result per request. */
    private static $adminVerified = null;
    private function isAdminAuthenticated(): bool {
        if (self::$adminVerified !== null) return self::$adminVerified;
        if (!empty($_SESSION['admin_logged_in'])) { self::$adminVerified = true; return true; }
        $token = $_COOKIE['admin_token'] ?? '';
        if (!$token) { self::$adminVerified = false; return false; }
        try {
            $admin = $this->db->fetchOne('SELECT id FROM admin_users WHERE admin_token = ? LIMIT 1', [$token]);
            self::$adminVerified = !empty($admin);
        } catch (Throwable $e) {
            // Column may not exist yet — fall back to old check (non-empty cookie)
            self::$adminVerified = !empty($token);
        }
        return self::$adminVerified;
    }

    /**
     * Simple file-based rate limiter. Returns true if allowed, false if blocked.
     */
    private function rateLimit(string $key, int $maxRequests = 30, int $windowSeconds = 60): bool {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $file = BASE_PATH . '/uploads/.ratelimit_' . md5($key . $ip) . '.json';
        $now = time();
        $data = [];
        if (is_file($file)) {
            $data = json_decode(@file_get_contents($file), true) ?: [];
            $data = array_filter($data, fn($t) => $t > $now - $windowSeconds);
        }
        if (count($data) >= $maxRequests) {
            http_response_code(429);
            echo json_encode(['error' => 'Too many requests. Try again later.']);
            return false;
        }
        $data[] = $now;
        @file_put_contents($file, json_encode($data));
        return true;
    }

    private function getTranslationService(): ?TranslationService {
        $lang = $_GET['lang'] ?? '';
        if (!in_array($lang, ['ru', 'en'], true)) return null;
        try { return new TranslationService(); } catch (Throwable $e) { return null; }
    }

    private function translateRow(array $row, TranslationService $svc, string $lang, array $fields): array {
        foreach ($fields as $f) {
            if (!empty($row[$f]) && is_string($row[$f]) && preg_match('/[\x{0590}-\x{05FF}]/u', $row[$f])) {
                $row[$f] = $svc->translate($row[$f], $lang);
            }
        }
        return $row;
    }

    private function hashPassword($password) {
        return hash('sha256', $password);
    }

    private function jsonResponse($data, $code = 200) {
        http_response_code($code);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    // ========================
    // Auth routes
    // ========================

    private function register() {
        $data = $this->getJson();
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $password = $data['password'] ?? '';
        $age = intval($data['age'] ?? 0);

        if (!$name || !$email || !$password) {
            return $this->jsonResponse(['error' => 'שם, אימייל וסיסמה הם שדות חובה'], 400);
        }

        $existing = $this->db->fetchOne('SELECT id FROM users WHERE email = ?', [$email]);
        if ($existing) {
            // If existing whatsapp user, log them in
            if (strpos($email, '@whatsapp.local') !== false) {
                $userData = $this->db->fetchOne('SELECT * FROM users WHERE id = ?', [$existing['id']]);
                $_SESSION['user_id'] = $existing['id'];
                $_SESSION['user_name'] = $userData['name'];
                $_SESSION['user_email'] = $userData['email'];
                return $this->jsonResponse(['message' => 'התחברת בהצלחה', 'user' => $userData]);
            }
            return $this->jsonResponse(['error' => 'כתובת האימייל כבר רשומה במערכת'], 400);
        }

        $hashedPassword = $this->hashPassword($password);
        $isWhatsappRegistration = strpos($email, '@whatsapp.local') !== false;

        // If WhatsApp registration - auto-verify (no email needed)
        $userId = $this->db->insert('users', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $hashedPassword,
            'email_verified' => $isWhatsappRegistration ? 1 : 0,
            'verify_token' => $isWhatsappRegistration ? null : bin2hex(random_bytes(32)),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // For WhatsApp users - log them in immediately
        if ($isWhatsappRegistration) {
            $userData = $this->db->fetchOne('SELECT * FROM users WHERE id = ?', [$userId]);
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;

            // Notify admin about new WhatsApp user
            try {
                require_once BASE_PATH . '/app/services/MailService.php';
                MailService::sendAdminNotification('new_user', ['name' => $name, 'email' => $email, 'phone' => $phone]);
            } catch(\Exception $e) {}

            return $this->jsonResponse(['message' => 'ההרשמה בוצעה בהצלחה', 'user' => $userData], 201);
        }

        $verifyToken = $this->db->fetchOne('SELECT verify_token FROM users WHERE id = ?', [$userId])['verify_token'] ?? '';

        // Send verification email
        require_once BASE_PATH . '/app/services/MailService.php';
        MailService::sendVerificationEmail(['name' => $name, 'email' => $email], $verifyToken);

        // Notify admin
        MailService::sendAdminNotification('new_user', ['name' => $name, 'email' => $email, 'phone' => $phone]);

        $this->jsonResponse(['message' => 'נשלח אליך מייל אימות. אנא אשר את כתובת המייל שלך כדי להתחבר.', 'needs_verification' => true], 201);
    }

    private function login() {
        $data = $this->getJson();
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if (!$email || !$password) {
            return $this->jsonResponse(['error' => 'אימייל וסיסמה הם שדות חובה'], 400);
        }

        $hashedPassword = $this->hashPassword($password);
        $user = $this->db->fetchOne('SELECT * FROM users WHERE email = ? AND password = ?', [$email, $hashedPassword]);

        if (!$user) {
            return $this->jsonResponse(['error' => 'אימייל או סיסמה שגויים'], 401);
        }

        // Check email verification
        if (empty($user['email_verified'])) {
            return $this->jsonResponse(['error' => 'יש לאמת את כתובת המייל לפני ההתחברות. בדוק את תיבת הדואר שלך.', 'needs_verification' => true, 'email' => $email], 403);
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        $this->jsonResponse(['message' => 'התחברת בהצלחה', 'user' => $user]);
    }

    // ========================
    // Email verification
    // ========================

    private function verifyEmail() {
        $token = $_GET['token'] ?? ($_POST['token'] ?? '');
        if (!$token) {
            $data = $this->getJson();
            $token = $data['token'] ?? '';
        }

        // If accessed via GET (from email link), show HTML page
        $isGet = $_SERVER['REQUEST_METHOD'] === 'GET';

        if (!$token) {
            if ($isGet) { $this->showVerifyPage(false, 'קישור אימות לא תקין'); return; }
            return $this->jsonResponse(['error' => 'טוקן אימות חסר'], 400);
        }

        $user = $this->db->fetchOne('SELECT id, name, email FROM users WHERE verify_token = ?', [$token]);
        if (!$user) {
            if ($isGet) { $this->showVerifyPage(false, 'קישור אימות לא תקין או שפג תוקפו'); return; }
            return $this->jsonResponse(['error' => 'קישור אימות לא תקין או שפג תוקפו'], 400);
        }

        $this->db->execute('UPDATE users SET email_verified = 1, verify_token = NULL WHERE id = ?', [$user['id']]);

        // Send welcome email now that they're verified
        require_once BASE_PATH . '/app/services/MailService.php';
        MailService::sendWelcomeEmail(['name' => $user['name'], 'email' => $user['email']]);

        if ($isGet) { $this->showVerifyPage(true, 'המייל אומת בהצלחה!', $user['name']); return; }
        $this->jsonResponse(['message' => 'המייל אומת בהצלחה! כעת ניתן להתחבר.', 'verified' => true]);
    }

    private function showVerifyPage($success, $message, $name = '') {
        header('Content-Type: text/html; charset=utf-8');
        $icon = $success ? '✓' : '✗';
        $color = $success ? '#16a34a' : '#dc2626';
        $greeting = $name ? "שלום $name!" : '';
        echo '<!DOCTYPE html><html dir="rtl" lang="he"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>אימות מייל</title></head>'
            . '<body style="margin:0;padding:0;min-height:100vh;display:flex;align-items:center;justify-content:center;background:#12110a;font-family:Arial,sans-serif;">'
            . '<div style="max-width:500px;margin:20px;padding:50px 40px;background:#1a1810;border:1px solid #393728;border-radius:20px;text-align:center;">'
            . '<div style="width:80px;height:80px;margin:0 auto 20px;border-radius:50%;background:' . $color . ';display:flex;align-items:center;justify-content:center;font-size:40px;color:#fff;">' . $icon . '</div>'
            . ($greeting ? '<p style="color:#f2d00d;font-size:20px;font-weight:700;margin-bottom:10px;">' . $greeting . '</p>' : '')
            . '<h1 style="color:#fff;font-size:24px;margin-bottom:15px;">' . htmlspecialchars($message) . '</h1>'
            . ($success ? '<p style="color:#888;font-size:16px;margin-bottom:30px;">החשבון שלך אומת בהצלחה. כעת תוכל להתחבר לאתר.</p>'
                . '<a href="' . BASE_URL . '/" style="display:inline-block;background:linear-gradient(135deg,#f2d00d,#b89b06);color:#12110a;padding:15px 40px;border-radius:12px;text-decoration:none;font-weight:900;font-size:16px;">כניסה לאתר</a>'
                : '<p style="color:#888;font-size:16px;margin-bottom:30px;">נסה להירשם מחדש או צור קשר עם התמיכה.</p>'
                . '<a href="' . BASE_URL . '/" style="display:inline-block;background:rgba(255,255,255,0.1);color:#fff;padding:15px 40px;border-radius:12px;text-decoration:none;font-weight:700;font-size:16px;">חזרה לאתר</a>')
            . '</div></body></html>';
        exit;
    }

    private function resendVerification() {
        $data = $this->getJson();
        $email = trim($data['email'] ?? '');

        if (!$email) {
            return $this->jsonResponse(['error' => 'נדרשת כתובת אימייל'], 400);
        }

        $user = $this->db->fetchOne('SELECT id, name, email, email_verified FROM users WHERE email = ?', [$email]);
        if (!$user) {
            return $this->jsonResponse(['message' => 'אם הכתובת קיימת, נשלח מייל אימות חדש']);
        }

        if (!empty($user['email_verified'])) {
            return $this->jsonResponse(['message' => 'המייל כבר אומת. ניתן להתחבר.']);
        }

        $newToken = bin2hex(random_bytes(32));
        $this->db->execute('UPDATE users SET verify_token = ? WHERE id = ?', [$newToken, $user['id']]);

        require_once BASE_PATH . '/app/services/MailService.php';
        MailService::sendVerificationEmail(['name' => $user['name'], 'email' => $email], $newToken);

        $this->jsonResponse(['message' => 'מייל אימות חדש נשלח. אנא בדוק את תיבת הדואר שלך.']);
    }

    // ========================
    // WhatsApp OTP
    // ========================

    private function sendWhatsappOtp() {
        $data = $this->getJson();
        $phone = trim($data['phone'] ?? '');

        if (!$phone) {
            return $this->jsonResponse(['error' => 'נדרש מספר טלפון'], 400);
        }

        require_once BASE_PATH . '/app/services/WhatsAppService.php';
        $result = WhatsAppService::sendOtp($phone);

        if ($result['success']) {
            $this->jsonResponse(['message' => $result['message']]);
        } else {
            $this->jsonResponse(['error' => $result['message']], 400);
        }
    }

    private function verifyWhatsappOtp() {
        $data = $this->getJson();
        $phone = trim($data['phone'] ?? '');
        $code = trim($data['code'] ?? '');

        if (!$phone || !$code) {
            return $this->jsonResponse(['error' => 'נדרש מספר טלפון וקוד'], 400);
        }

        require_once BASE_PATH . '/app/services/WhatsAppService.php';
        $valid = WhatsAppService::verifyOtp($phone, $code);

        if (!$valid) {
            return $this->jsonResponse(['error' => 'קוד שגוי או שפג תוקף'], 400);
        }

        // Find user by phone (any format)
        $normalizedPhone = WhatsAppService::normalizePhone($phone);
        $last9 = substr($normalizedPhone, -9);
        $user = $this->db->fetchOne(
            "SELECT * FROM users
             WHERE REPLACE(REPLACE(REPLACE(REPLACE(phone, '-', ''), ' ', ''), '+', ''), '(', '') LIKE ?
             ORDER BY id DESC LIMIT 1",
            ['%' . $last9 . '%']
        );

        if ($user) {
            // Existing user - verify and log in
            $this->db->execute('UPDATE users SET email_verified = 1, verify_token = NULL WHERE id = ?', [$user['id']]);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            // Set cookie token for Varnish/session compatibility
            setcookie('user_token', hash('sha256', $user['email'] . session_id()), time() + 86400 * 30, '/', '', false, true);
            return $this->jsonResponse(['message' => 'התחברת בהצלחה!', 'user' => $user]);
        }

        // User doesn't exist yet - return code valid, frontend will register
        $this->jsonResponse(['message' => 'קוד תקין', 'verified' => true, 'phone' => $normalizedPhone]);
    }

    // ========================
    // User routes
    // ========================

    private function handleUser($subAction, $method) {
        switch ($subAction) {
            case 'profile':
                if ($method === 'GET') {
                    $this->getUserProfile();
                } elseif ($method === 'PUT') {
                    $this->updateUserProfile();
                }
                break;
            case 'change-password':
                $this->changePassword();
                break;
            case 'messages':
                $this->getUserMessages();
                break;
            case 'logout':
                unset($_SESSION['user_id']);
                unset($_SESSION['user_name']);
                unset($_SESSION['user_email']);
                setcookie('user_token', '', time() - 3600, '/', '', false, true);
                $this->jsonResponse(['message' => 'התנתקת בהצלחה']);
                break;
            default:
                $this->jsonResponse(['error' => 'User route not found'], 404);
        }
    }

    private function getUserMessages() {
        $userId = $_GET['user_id'] ?? ($_SESSION['user_id'] ?? ($_SERVER['HTTP_X_USER_ID'] ?? null));
        if (!$userId) {
            return $this->jsonResponse(['error' => 'נדרש מזהה משתמש'], 400);
        }
        $messages = $this->db->fetchAll(
            'SELECT * FROM messages WHERE user_id = ? ORDER BY created_at DESC',
            [$userId]
        );
        $this->jsonResponse(['messages' => $messages]);
    }

    private function getUserProfile() {
        $userId = $_GET['user_id'] ?? ($_SESSION['user_id'] ?? ($_SERVER['HTTP_X_USER_ID'] ?? null));
        if (!$userId) {
            return $this->jsonResponse(['error' => 'נדרש מזהה משתמש'], 400);
        }

        $user = $this->db->fetchOne('SELECT * FROM users WHERE id = ?', [$userId]);
        if (!$user) {
            return $this->jsonResponse(['error' => 'משתמש לא נמצא'], 404);
        }
        // Don't expose password
        unset($user['password']);
        unset($user['reset_token']);
        unset($user['verify_token']);
        $this->jsonResponse($user);
    }

    private function updateUserProfile() {
        $data = $this->getJson();
        $userId = $data['user_id'] ?? ($_SESSION['user_id'] ?? ($_SERVER['HTTP_X_USER_ID'] ?? null));
        if (!$userId) {
            return $this->jsonResponse(['error' => 'נדרש מזהה משתמש'], 400);
        }

        $fields = [];
        $params = [];

        if (isset($data['name'])) {
            $fields[] = 'name = ?';
            $params[] = trim($data['name']);
        }
        if (isset($data['phone'])) {
            $fields[] = 'phone = ?';
            $params[] = trim($data['phone']);
        }
        if (isset($data['email'])) {
            $fields[] = 'email = ?';
            $params[] = trim($data['email']);
        }
        if (isset($data['avatar'])) {
            // Ensure avatar column exists (ignore errors)
            try { $this->db->execute("ALTER TABLE users ADD COLUMN avatar VARCHAR(500) DEFAULT NULL"); } catch (\Exception $e) {}
            $fields[] = 'avatar = ?';
            $params[] = trim($data['avatar']);
        }
        if (isset($data['city'])) {
            try { $this->db->execute("ALTER TABLE users ADD COLUMN city VARCHAR(100) DEFAULT NULL"); } catch (\Exception $e) {}
            $fields[] = 'city = ?';
            $params[] = trim($data['city']);
        }
        if (isset($data['age'])) {
            try { $this->db->execute("ALTER TABLE users ADD COLUMN age INT DEFAULT NULL"); } catch (\Exception $e) {}
            $fields[] = 'age = ?';
            $params[] = intval($data['age']);
        }

        if (empty($fields)) {
            return $this->jsonResponse(['error' => 'לא נשלחו שדות לעדכון'], 400);
        }

        $params[] = $userId;
        $this->db->execute('UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = ?', $params);

        $user = $this->db->fetchOne('SELECT id, name, email, phone, vip_level FROM users WHERE id = ?', [$userId]);
        $this->jsonResponse(['message' => 'הפרופיל עודכן בהצלחה', 'user' => $user]);
    }

    private function changePassword() {
        $data = $this->getJson();
        $userId = $data['user_id'] ?? ($_SESSION['user_id'] ?? ($_SERVER['HTTP_X_USER_ID'] ?? null));
        $currentPassword = $data['current_password'] ?? '';
        $newPassword = $data['new_password'] ?? '';

        if (!$userId || !$currentPassword || !$newPassword) {
            return $this->jsonResponse(['error' => 'כל השדות הם חובה'], 400);
        }

        $hashedCurrent = $this->hashPassword($currentPassword);
        $user = $this->db->fetchOne('SELECT id FROM users WHERE id = ? AND password = ?', [$userId, $hashedCurrent]);

        if (!$user) {
            return $this->jsonResponse(['error' => 'הסיסמה הנוכחית שגויה'], 400);
        }

        $hashedNew = $this->hashPassword($newPassword);
        $this->db->execute('UPDATE users SET password = ? WHERE id = ?', [$hashedNew, $userId]);

        $this->jsonResponse(['message' => 'הסיסמה שונתה בהצלחה']);
    }

    // ========================
    // Password recovery
    // ========================

    private function forgotPassword() {
        $data = $this->getJson();
        $email = trim($data['email'] ?? '');

        if (!$email) {
            return $this->jsonResponse(['error' => 'נדרשת כתובת אימייל'], 400);
        }

        $user = $this->db->fetchOne('SELECT id FROM users WHERE email = ?', [$email]);
        if (!$user) {
            // Return success even if email not found for security
            return $this->jsonResponse(['message' => 'אם הכתובת קיימת במערכת, נשלח אליה קישור לאיפוס סיסמה']);
        }

        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->db->execute('UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE id = ?', [$token, $expiry, $user['id']]);

        // Send reset email
        require_once BASE_PATH . '/app/services/MailService.php';
        MailService::sendPasswordResetEmail($email, $token);

        $this->jsonResponse(['message' => 'אם הכתובת קיימת במערכת, נשלח אליה קישור לאיפוס סיסמה']);
    }

    private function resetPassword() {
        $data = $this->getJson();
        $token = $data['token'] ?? '';
        $newPassword = $data['new_password'] ?? '';

        if (!$token || !$newPassword) {
            return $this->jsonResponse(['error' => 'טוקן וסיסמה חדשה הם שדות חובה'], 400);
        }

        $user = $this->db->fetchOne('SELECT id FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()', [$token]);
        if (!$user) {
            return $this->jsonResponse(['error' => 'טוקן לא תקין או שפג תוקפו'], 400);
        }

        $hashedPassword = $this->hashPassword($newPassword);
        $this->db->execute('UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?', [$hashedPassword, $user['id']]);

        $this->jsonResponse(['message' => 'הסיסמה אופסה בהצלחה']);
    }

    // ========================
    // Leads
    // ========================

    private function createLead() {
        $data = $this->getJson();
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $message = trim($data['message'] ?? '');
        $source = trim($data['source'] ?? 'website');
        $packageType = trim($data['package_type'] ?? '');

        if (!$name) {
            return $this->jsonResponse(['error' => 'שם הוא שדה חובה'], 400);
        }

        $this->db->insert('leads', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
            'source' => $source,
            'package_type' => $packageType,
            'status' => 'new',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Notify admin
        require_once BASE_PATH . '/app/services/MailService.php';
        MailService::sendAdminNotification('new_lead', ['name' => $name, 'email' => $email, 'phone' => $phone, 'message' => $message]);

        $this->jsonResponse(['message' => 'הפנייה נשלחה בהצלחה! ניצור איתך קשר בהקדם'], 201);
    }

    private function getLeads() {
        $leads = $this->db->fetchAll('SELECT * FROM leads ORDER BY created_at DESC');
        $this->jsonResponse($leads);
    }

    // ========================
    // Contact
    // ========================

    private function contactSubmit() {
        $data = $this->getJson();
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $subject = trim($data['subject'] ?? '');
        $message = trim($data['message'] ?? '');

        if (!$name || !$email || !$message) {
            return $this->jsonResponse(['error' => 'שם, אימייל והודעה הם שדות חובה'], 400);
        }

        $this->db->insert('leads', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => ($subject ? $subject . ': ' : '') . $message,
            'source' => 'contact_form',
            'status' => 'new',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Notify admin
        require_once BASE_PATH . '/app/services/MailService.php';
        MailService::sendAdminNotification('new_lead', ['name' => $name, 'email' => $email, 'phone' => $phone, 'message' => ($subject ? $subject . ': ' : '') . $message]);

        $this->jsonResponse(['message' => 'ההודעה נשלחה בהצלחה! ניצור איתך קשר בהקדם'], 201);
    }

    // ========================
    // Profiles (public)
    // ========================

    private function handleProfiles($subAction, $method) {
        if ($subAction && is_numeric($subAction)) {
            $this->getProfileById($subAction);
        } else {
            $this->getProfiles();
        }
    }

    // Minimal public fields for profile listing (guests see less)
    // Guest profile listing: minimal fields only (no bio, no personal details)
    private static $PUBLIC_LIST_FIELDS = ['id','name','age','country','city','occupation','marital_status','primary_photo'];

    private function stripProfile(array $p): array {
        $out = [];
        foreach (self::$PUBLIC_LIST_FIELDS as $f) {
            if (array_key_exists($f, $p)) $out[$f] = $p[$f];
        }
        return $out;
    }

    private function getProfiles() {
        if (!$this->rateLimit('profiles', 30, 60)) return; // 30 req/min per IP
        $page = max(1, intval($_GET['page'] ?? 1));
        $perPage = max(1, min(12, intval($_GET['per_page'] ?? 12))); // Hard cap at 12
        $offset = ($page - 1) * $perPage;

        $where = ['p.is_active = TRUE'];
        $params = [];

        if (!empty($_GET['country'])) {
            $where[] = 'p.country = ?';
            $params[] = $_GET['country'];
        }
        if (!empty($_GET['age_min'])) {
            $where[] = 'p.age >= ?';
            $params[] = intval($_GET['age_min']);
        }
        if (!empty($_GET['age_max'])) {
            $where[] = 'p.age <= ?';
            $params[] = intval($_GET['age_max']);
        }
        if (!empty($_GET['marital_status'])) {
            $where[] = 'p.marital_status = ?';
            $params[] = $_GET['marital_status'];
        }
        if (!empty($_GET['q'])) {
            $where[] = 'p.name LIKE ?';
            $params[] = '%' . $_GET['q'] . '%';
        }

        $whereClause = implode(' AND ', $where);

        $countResult = $this->db->fetchOne("SELECT COUNT(*) as total FROM profiles p WHERE $whereClause", $params);
        $total = $countResult['total'] ?? 0;

        $countParams = $params;
        $params[] = $perPage;
        $params[] = $offset;

        $profiles = $this->db->fetchAll(
            "SELECT p.id, p.name, p.age, p.country, p.city, p.occupation, p.education,
                    p.languages, p.hobbies, p.marital_status, p.about, p.looking_for,
                    COALESCE(
                        (SELECT pp.photo_url FROM profile_photos pp WHERE pp.profile_id = p.id AND pp.is_primary = TRUE LIMIT 1),
                        (SELECT pp.photo_url FROM profile_photos pp WHERE pp.profile_id = p.id ORDER BY pp.id ASC LIMIT 1)
                    ) as primary_photo
             FROM profiles p
             WHERE $whereClause
             ORDER BY p.created_at DESC
             LIMIT ? OFFSET ?",
            $params
        );

        // Strip any extra fields for non-admin users
        $isAdmin = $this->isAdminAuthenticated();
        if (!$isAdmin) {
            $profiles = array_map(fn($p) => $this->stripProfile($p), $profiles);
        }

        $lang = $_GET['lang'] ?? '';
        $svc = $this->getTranslationService();
        if ($svc && $lang) {
            $pFields = ['name','city','occupation','education','languages','hobbies','about','looking_for'];
            $profiles = array_map(fn($p) => $this->translateRow($p, $svc, $lang, $pFields), $profiles);
        }

        $this->jsonResponse([
            'profiles' => $profiles,
            'total' => intval($total),
            'page' => $page,
            'per_page' => $perPage,
            'total_pages' => ceil($total / $perPage)
        ]);
    }

    private function getProfileById($id) {
        if (!$this->rateLimit('profile_view', 60, 60)) return; // 60 req/min per IP

        $profile = $this->db->fetchOne('SELECT * FROM profiles WHERE id = ? AND is_active = TRUE', [$id]);
        if (!$profile) {
            return $this->jsonResponse(['error' => 'פרופיל לא נמצא'], 404);
        }

        $photos = $this->db->fetchAll('SELECT photo_url, is_primary FROM profile_photos WHERE profile_id = ? ORDER BY is_primary DESC, id ASC', [$id]);
        $profile['photos'] = $photos;

        $videos = $this->db->fetchAll('SELECT video_url, title FROM profile_videos WHERE profile_id = ? ORDER BY id ASC', [$id]);
        $profile['videos'] = $videos;

        $this->db->execute('UPDATE profiles SET views = COALESCE(views, 0) + 1 WHERE id = ?', [$id]);

        $lang = $_GET['lang'] ?? '';
        $svc = $this->getTranslationService();
        if ($svc && $lang) {
            $profile = $this->translateRow($profile, $svc, $lang, ['name','city','occupation','education','languages','hobbies','about','looking_for']);
        }

        // Strip internal fields for non-admin
        $isAdmin = $this->isAdminAuthenticated();
        if (!$isAdmin) {
            unset($profile['created_at'], $profile['updated_at'], $profile['views'],
                  $profile['weight'], $profile['height'], $profile['children'],
                  $profile['zodiac'], $profile['is_active']);
        }

        $this->jsonResponse($profile);
    }

    // ========================
    // Stories (public)
    // ========================

    private function getStories() {
        $stories = $this->db->fetchAll('SELECT * FROM success_stories WHERE is_active = TRUE ORDER BY created_at DESC');
        $lang = $_GET['lang'] ?? '';
        $svc = $this->getTranslationService();
        if ($svc && $lang) {
            $stories = array_map(fn($s) => $this->translateRow($s, $svc, $lang, ['title','couple_names','story']), $stories);
        }
        $this->jsonResponse($stories);
    }

    // ========================
    // Messages
    // ========================

    private function sendMessage() {
        $data = $this->getJson();
        $senderName = trim($data['sender_name'] ?? '');
        $senderEmail = trim($data['sender_email'] ?? '');
        $profileId = $data['profile_id'] ?? null;
        $message = trim($data['message'] ?? '');
        $userId = $data['user_id'] ?? ($_SESSION['user_id'] ?? null);

        if (!$senderName || !$senderEmail || !$message) {
            return $this->jsonResponse(['error' => 'שם, אימייל והודעה הם שדות חובה'], 400);
        }

        $this->db->insert('messages', [
            'sender_name' => $senderName,
            'sender_email' => $senderEmail,
            'profile_id' => $profileId,
            'user_id' => $userId,
            'message' => $message,
            'is_read' => false,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $this->jsonResponse(['message' => 'ההודעה נשלחה בהצלחה'], 201);
    }

    // ========================
    // Process steps (public)
    // ========================

    private function getProcessSteps() {
        $steps = $this->db->fetchAll('SELECT * FROM process_steps ORDER BY step_number ASC');
        $lang = $_GET['lang'] ?? '';
        $svc = $this->getTranslationService();
        if ($svc && $lang) {
            $steps = array_map(fn($s) => $this->translateRow($s, $svc, $lang, ['title','description']), $steps);
        }
        $this->jsonResponse($steps);
    }

    // ========================
    // FAQs (public)
    // ========================

    private function getFaqs() {
        $faqs = $this->db->fetchAll('SELECT * FROM faqs WHERE is_active = TRUE ORDER BY sort_order ASC, id ASC');
        $lang = $_GET['lang'] ?? '';
        $svc = $this->getTranslationService();
        if ($svc && $lang) {
            $faqs = array_map(fn($f) => $this->translateRow($f, $svc, $lang, ['question','answer']), $faqs);
        }
        $this->jsonResponse($faqs);
    }

    private function getReviews() {
        $reviews = $this->db->fetchAll('SELECT * FROM reviews WHERE is_active = TRUE ORDER BY id DESC');
        $lang = $_GET['lang'] ?? '';
        $svc = $this->getTranslationService();
        if ($svc && $lang) {
            $reviews = array_map(fn($r) => $this->translateRow($r, $svc, $lang, ['client_name','review_text']), $reviews);
        }
        $this->jsonResponse($reviews);
    }

    // ========================
    // File upload
    // ========================

    private function upload() {
        if (empty($_FILES['file'])) {
            return $this->jsonResponse(['error' => 'לא נבחר קובץ'], 400);
        }

        $file = $_FILES['file'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jfif', 'image/pjpeg', 'image/bmp', 'image/svg+xml',
            'video/mp4', 'video/webm', 'video/ogg', 'video/quicktime', 'video/x-msvideo', 'video/x-ms-wmv'];

        // Also check by extension for browsers that report wrong MIME types
        $allowedExts = ['jpg', 'jpeg', 'jfif', 'png', 'webp', 'gif', 'bmp', 'svg',
            'mp4', 'webm', 'ogg', 'mov', 'avi', 'wmv'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($file['type'], $allowedTypes) && !in_array($ext, $allowedExts)) {
            return $this->jsonResponse(['error' => 'סוג קובץ לא נתמך'], 400);
        }

        $maxSize = 100 * 1024 * 1024; // 100MB for videos
        if ($file['size'] > $maxSize) {
            return $this->jsonResponse(['error' => 'גודל הקובץ חורג מ-5MB'], 400);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('upload_') . '.' . $ext;
        $uploadDir = BASE_PATH . '/public/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $destination = $uploadDir . $filename;
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return $this->jsonResponse(['error' => 'שגיאה בהעלאת הקובץ'], 500);
        }

        $url = BASE_URL . '/public/uploads/' . $filename;
        $this->jsonResponse(['message' => 'הקובץ הועלה בהצלחה', 'url' => $url, 'filename' => $filename], 201);
    }

    // ========================
    // Admin routes
    // ========================

    private function handleAdmin($subAction, $id, $method) {
        switch ($subAction) {
            case 'login':
                $this->adminLogin();
                break;
            case 'logout':
                $this->adminLogout();
                break;
            case 'settings':
                if ($method === 'GET') {
                    $this->getSettings();
                } else {
                    $this->updateSettings();
                }
                break;
            case 'profiles':
                $this->adminProfiles($id, $method);
                break;
            case 'photos':
                $this->adminPhotos($id, $method);
                break;
            case 'videos':
                $this->adminVideos($id, $method);
                break;
            case 'users':
                $this->adminUsers($id, $method);
                break;
            case 'messages':
                $this->adminMessages($id, $method);
                break;
            case 'leads':
                $this->adminLeads($id, $method);
                break;
            case 'pages':
                $this->adminPages($id, $method);
                break;
            case 'stories':
                $this->adminStories($id, $method);
                break;
            case 'faqs':
                $this->adminFaqs($id, $method);
                break;
            case 'reviews':
                $this->adminReviews($id, $method);
                break;
            case 'process-steps':
                $this->adminProcessSteps($id, $method);
                break;
            case 'blocks':
                $this->adminBlocks($id, $method);
                break;
            case 'blocks-reorder':
                $this->adminBlocksReorder();
                break;
            case 'translations':
                $this->adminTranslations($id, $method);
                break;
            default:
                $this->jsonResponse(['error' => 'Admin route not found'], 404);
        }
    }

    // ========================
    // Admin: Translations CRUD
    // ========================
    private function adminTranslations($id, $method) {
        if ($method === 'GET') {
            $lang = $_GET['lang'] ?? '';
            $q = trim($_GET['q'] ?? '');
            $where = []; $params = [];
            if ($lang && in_array($lang, ['ru', 'en'], true)) { $where[] = 'lang = ?'; $params[] = $lang; }
            if ($q !== '') { $where[] = '(source_text LIKE ? OR translation LIKE ?)'; $params[] = "%$q%"; $params[] = "%$q%"; }
            $sql = "SELECT id, source_text, lang, translation, is_manual, updated_at FROM translations_cache";
            if ($where) $sql .= ' WHERE ' . implode(' AND ', $where);
            $sql .= ' ORDER BY updated_at DESC LIMIT 500';
            return $this->jsonResponse(['items' => $this->db->fetchAll($sql, $params)]);
        }
        if ($method === 'PUT' && $id) {
            $data = $this->getJson();
            $translation = trim($data['translation'] ?? '');
            if ($translation === '') return $this->jsonResponse(['error' => 'translation required'], 400);
            $this->db->execute(
                "UPDATE translations_cache SET translation = ?, is_manual = 1 WHERE id = ?",
                [$translation, (int)$id]
            );
            return $this->jsonResponse(['message' => 'saved']);
        }
        if ($method === 'DELETE' && $id) {
            $this->db->execute("DELETE FROM translations_cache WHERE id = ?", [(int)$id]);
            return $this->jsonResponse(['message' => 'deleted']);
        }
        if ($method === 'POST') {
            $data = $this->getJson();
            $text = trim($data['source_text'] ?? '');
            $lang = $data['lang'] ?? '';
            $translation = trim($data['translation'] ?? '');
            if ($text === '' || $translation === '' || !in_array($lang, ['ru', 'en'], true)) {
                return $this->jsonResponse(['error' => 'source_text, lang (ru|en), translation required'], 400);
            }
            $hash = sha1($text);
            $this->db->execute(
                "INSERT INTO translations_cache (source_text, source_hash, lang, translation, is_manual)
                 VALUES (?, ?, ?, ?, 1)
                 ON DUPLICATE KEY UPDATE translation = VALUES(translation), is_manual = 1",
                [mb_substr($text, 0, 1000), $hash, $lang, $translation]
            );
            return $this->jsonResponse(['message' => 'saved']);
        }
        return $this->jsonResponse(['error' => 'invalid method'], 405);
    }

    // ========================
    // Admin: Auth
    // ========================

    private function adminLogin() {
        // Brute-force protection: max 5 login attempts per IP per 15 minutes
        if (!$this->rateLimit('admin_login', 5, 900)) return;

        $data = $this->getJson();
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if (!$email || !$password) {
            return $this->jsonResponse(['error' => 'אימייל וסיסמה הם שדות חובה'], 400);
        }

        $hashedPassword = $this->hashPassword($password);
        $admin = $this->db->fetchOne(
            'SELECT id, email, full_name FROM admin_users WHERE email = ? AND password = ?',
            [$email, $hashedPassword]
        );

        if (!$admin) {
            return $this->jsonResponse(['error' => 'אימייל או סיסמה שגויים'], 401);
        }

        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_email'] = $admin['email'];

        // Generate cryptographically secure token, store in DB, set as cookie
        $token = bin2hex(random_bytes(32));
        try {
            $this->db->execute("ALTER TABLE admin_users ADD COLUMN IF NOT EXISTS admin_token VARCHAR(128) DEFAULT NULL", []);
        } catch (Throwable $e) {} // column may already exist
        $this->db->execute('UPDATE admin_users SET admin_token = ? WHERE id = ?', [$token, $admin['id']]);
        setcookie('admin_token', $token, time() + 86400, '/', '', true, true);

        $this->jsonResponse(['message' => 'התחברת בהצלחה', 'admin' => $admin]);
    }

    private function adminLogout() {
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
        // Clear admin cookie
        setcookie('admin_token', '', time() - 3600, '/', '', false, true);
        $this->jsonResponse(['message' => 'התנתקת בהצלחה']);
    }

    // ========================
    // Admin: Settings
    // ========================

    private function getSettings() {
        $settings = $this->db->fetchAll('SELECT * FROM settings');
        $result = [];
        foreach ($settings as $setting) {
            $result[$setting['setting_key']] = $setting['setting_value'];
        }
        $this->jsonResponse($result);
    }

    private function updateSettings() {
        $raw = file_get_contents('php://input');
        // Ensure UTF-8 encoding
        if (!mb_check_encoding($raw, 'UTF-8')) {
            $raw = mb_convert_encoding($raw, 'UTF-8', 'auto');
        }
        $data = json_decode($raw, true);
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            // Try cleaning BOM and control characters
            $raw = preg_replace('/[\x00-\x1F\x80-\x9F]/u', '', $raw);
            $data = json_decode($raw, true);
        }
        if (!is_array($data) || empty($data)) {
            return $this->jsonResponse(['error' => 'Invalid request data'], 400);
        }

        $saved = 0;
        foreach ($data as $key => $value) {
            if (!is_string($key) || $key === '') continue;
            $existing = $this->db->fetchOne('SELECT id FROM settings WHERE setting_key = ?', [$key]);
            if ($existing) {
                $this->db->execute('UPDATE settings SET setting_value = ? WHERE setting_key = ?', [(string)$value, $key]);
            } else {
                $this->db->insert('settings', [
                    'setting_key' => $key,
                    'setting_value' => (string)$value
                ]);
            }
            $saved++;
        }

        $this->jsonResponse(['message' => 'ההגדרות עודכנו בהצלחה', 'saved' => $saved]);
    }

    // ========================
    // Admin: Profiles
    // ========================

    private function adminProfiles($id, $method) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $profile = $this->db->fetchOne('SELECT * FROM profiles WHERE id = ?', [$id]);
                    if (!$profile) {
                        return $this->jsonResponse(['error' => 'פרופיל לא נמצא'], 404);
                    }
                    $photos = $this->db->fetchAll('SELECT * FROM profile_photos WHERE profile_id = ? ORDER BY is_primary DESC, id ASC', [$id]);
                    $profile['photos'] = $photos;
                    $videos = $this->db->fetchAll('SELECT * FROM profile_videos WHERE profile_id = ? ORDER BY id ASC', [$id]);
                    $profile['videos'] = $videos;
                    $this->jsonResponse($profile);
                } else {
                    $page = max(1, intval($_GET['page'] ?? 1));
                    $perPage = max(1, min(100, intval($_GET['per_page'] ?? 20)));
                    $offset = ($page - 1) * $perPage;

                    $countResult = $this->db->fetchOne('SELECT COUNT(*) as total FROM profiles');
                    $total = $countResult['total'] ?? 0;

                    $profiles = $this->db->fetchAll(
                        'SELECT p.*,
                                COALESCE(
                                    (SELECT pp.photo_url FROM profile_photos pp WHERE pp.profile_id = p.id AND pp.is_primary = TRUE LIMIT 1),
                                    (SELECT pp.photo_url FROM profile_photos pp WHERE pp.profile_id = p.id ORDER BY pp.id ASC LIMIT 1)
                                ) as primary_photo
                         FROM profiles p
                         ORDER BY p.created_at DESC
                         LIMIT ? OFFSET ?',
                        [$perPage, $offset]
                    );

                    $this->jsonResponse([
                        'profiles' => $profiles,
                        'total' => intval($total),
                        'page' => $page,
                        'per_page' => $perPage,
                        'total_pages' => ceil($total / $perPage)
                    ]);
                }
                break;

            case 'POST':
                $data = $this->getJson();
                $name = trim($data['name'] ?? '');
                $age = intval($data['age'] ?? 0);
                $country = trim($data['country'] ?? '');
                $city = trim($data['city'] ?? '');
                $height = trim($data['height'] ?? '');
                $weight = trim($data['weight'] ?? '');
                $maritalStatus = trim($data['marital_status'] ?? '');
                $children = $data['children'] ?? null;
                $education = trim($data['education'] ?? '');
                $occupation = trim($data['occupation'] ?? '');
                $languages = trim($data['languages'] ?? '');
                $about = trim($data['about'] ?? '');
                $lookingFor = trim($data['looking_for'] ?? '');
                $hobbies = trim($data['hobbies'] ?? '');
                $zodiac = trim($data['zodiac'] ?? '');
                $isActive = isset($data['is_active']) ? (bool)$data['is_active'] : true;

                if (!$name || !$age || !$country) {
                    return $this->jsonResponse(['error' => 'שם, גיל ומדינה הם שדות חובה'], 400);
                }

                $this->db->insert('profiles', [
                    'name' => $name,
                    'age' => $age,
                    'country' => $country,
                    'city' => $city,
                    'height' => $height,
                    'weight' => $weight,
                    'marital_status' => $maritalStatus,
                    'children' => $children,
                    'education' => $education,
                    'occupation' => $occupation,
                    'languages' => $languages,
                    'about' => $about,
                    'looking_for' => $lookingFor,
                    'hobbies' => $hobbies,
                    'zodiac' => $zodiac,
                    'is_active' => $isActive,
                    'views' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $newProfile = $this->db->fetchOne('SELECT * FROM profiles ORDER BY id DESC LIMIT 1');
                $this->jsonResponse(['message' => 'הפרופיל נוצר בהצלחה', 'profile' => $newProfile], 201);
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה פרופיל'], 400);
                }
                $data = $this->getJson();
                $fields = [];
                $params = [];

                $allowedFields = ['name', 'age', 'country', 'city', 'height', 'weight', 'marital_status', 'children', 'education', 'occupation', 'languages', 'about', 'looking_for', 'hobbies', 'zodiac', 'is_active'];

                foreach ($allowedFields as $field) {
                    if (isset($data[$field])) {
                        $fields[] = "$field = ?";
                        $params[] = $data[$field];
                    }
                }

                if (empty($fields)) {
                    return $this->jsonResponse(['error' => 'לא נשלחו שדות לעדכון'], 400);
                }

                $params[] = $id;
                $this->db->execute('UPDATE profiles SET ' . implode(', ', $fields) . ' WHERE id = ?', $params);

                $profile = $this->db->fetchOne('SELECT * FROM profiles WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'הפרופיל עודכן בהצלחה', 'profile' => $profile]);
                break;

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה פרופיל'], 400);
                }
                $this->db->execute('DELETE FROM profile_photos WHERE profile_id = ?', [$id]);
                $this->db->execute('DELETE FROM profiles WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'הפרופיל נמחק בהצלחה']);
                break;
        }
    }

    // ========================
    // Admin: Photos
    // ========================

    private function adminPhotos($id, $method) {
        switch ($method) {
            case 'POST':
                $profileId = $_POST['profile_id'] ?? null;
                $isPrimary = isset($_POST['is_primary']) ? (bool)$_POST['is_primary'] : false;

                if (!$profileId) {
                    // Try JSON body
                    $data = $this->getJson();
                    $profileId = $data['profile_id'] ?? null;
                    $isPrimary = isset($data['is_primary']) ? (bool)$data['is_primary'] : false;
                    $photoUrl = trim($data['photo_url'] ?? '');

                    if (!$profileId || !$photoUrl) {
                        return $this->jsonResponse(['error' => 'נדרש מזהה פרופיל וכתובת תמונה'], 400);
                    }

                    // Auto-set as primary if this is the first photo for this profile
                    $existingCount = $this->db->fetchOne('SELECT COUNT(*) as cnt FROM profile_photos WHERE profile_id = ?', [$profileId]);
                    if (!$existingCount || $existingCount['cnt'] == 0) {
                        $isPrimary = true;
                    }

                    if ($isPrimary) {
                        $this->db->execute('UPDATE profile_photos SET is_primary = FALSE WHERE profile_id = ?', [$profileId]);
                    }

                    $this->db->insert('profile_photos', [
                        'profile_id' => intval($profileId),
                        'photo_url' => $photoUrl,
                        'is_primary' => $isPrimary ? 1 : 0,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);

                    $photo = $this->db->fetchOne('SELECT * FROM profile_photos ORDER BY id DESC LIMIT 1');
                    return $this->jsonResponse(['message' => 'התמונה נוספה בהצלחה', 'photo' => $photo], 201);
                }

                // File upload
                if (empty($_FILES['photo'])) {
                    return $this->jsonResponse(['error' => 'לא נבחר קובץ'], 400);
                }

                $file = $_FILES['photo'];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/jfif', 'image/pjpeg', 'image/bmp'];
                $allowedExts = ['jpg', 'jpeg', 'jfif', 'png', 'webp', 'gif', 'bmp'];
                $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if (!in_array($file['type'], $allowedTypes) && !in_array($fileExt, $allowedExts)) {
                    return $this->jsonResponse(['error' => 'סוג קובץ לא נתמך'], 400);
                }

                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = 'profile_' . $profileId . '_' . uniqid() . '.' . $ext;
                $uploadDir = BASE_PATH . '/public/uploads/profiles/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
                    return $this->jsonResponse(['error' => 'שגיאה בהעלאת הקובץ'], 500);
                }

                $photoUrl = BASE_URL . '/public/uploads/profiles/' . $filename;

                if ($isPrimary) {
                    $this->db->execute('UPDATE profile_photos SET is_primary = FALSE WHERE profile_id = ?', [$profileId]);
                }

                $this->db->insert('profile_photos', [
                    'profile_id' => intval($profileId),
                    'photo_url' => $photoUrl,
                    'is_primary' => $isPrimary ? 1 : 0,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $photo = $this->db->fetchOne('SELECT * FROM profile_photos ORDER BY id DESC LIMIT 1');
                $this->jsonResponse(['message' => 'התמונה הועלתה בהצלחה', 'photo' => $photo], 201);
                break;

            case 'DELETE':
                // Delete all photos for a profile
                $profileId = $_GET['profile_id'] ?? null;
                if ($profileId) {
                    $this->db->execute('DELETE FROM profile_photos WHERE profile_id = ?', [$profileId]);
                    return $this->jsonResponse(['message' => 'כל התמונות נמחקו בהצלחה']);
                }

                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה תמונה'], 400);
                }

                $photo = $this->db->fetchOne('SELECT * FROM profile_photos WHERE id = ?', [$id]);
                if (!$photo) {
                    return $this->jsonResponse(['error' => 'תמונה לא נמצאה'], 404);
                }

                // Try to delete the file from disk (with path traversal protection)
                $urlPath = parse_url($photo['photo_url'], PHP_URL_PATH);
                $filePath = realpath(BASE_PATH . $urlPath);
                $uploadDir = realpath(BASE_PATH . '/public/uploads');
                if ($filePath && $uploadDir && strpos($filePath, $uploadDir) === 0 && file_exists($filePath)) {
                    unlink($filePath);
                }

                $this->db->execute('DELETE FROM profile_photos WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'התמונה נמחקה בהצלחה']);
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה תמונה'], 400);
                }
                $data = $this->getJson();
                $photo = $this->db->fetchOne('SELECT * FROM profile_photos WHERE id = ?', [$id]);
                if (!$photo) {
                    return $this->jsonResponse(['error' => 'תמונה לא נמצאה'], 404);
                }
                // Set as primary
                $pid = $photo['profile_id'];
                $this->db->execute('UPDATE profile_photos SET is_primary = FALSE WHERE profile_id = ?', [$pid]);
                $this->db->execute('UPDATE profile_photos SET is_primary = TRUE WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'תמונה ראשית עודכנה']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Admin: Videos
    // ========================

    private function adminVideos($id, $method) {
        switch ($method) {
            case 'POST':
                $data = $this->getJson();
                $profileId = $data['profile_id'] ?? null;
                $videoUrl = trim($data['video_url'] ?? '');
                $title = trim($data['title'] ?? '');

                if (!$profileId || !$videoUrl) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה פרופיל וכתובת סרטון'], 400);
                }

                $videoData = [
                    'profile_id' => intval($profileId),
                    'video_url' => $videoUrl,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                // Only add title if column exists
                try {
                    $this->db->insert('profile_videos', array_merge($videoData, ['title' => $title ?: '']));
                } catch (\Exception $e) {
                    // title column might not exist, try without it
                    $this->db->insert('profile_videos', $videoData);
                }

                $video = $this->db->fetchOne('SELECT * FROM profile_videos ORDER BY id DESC LIMIT 1');
                return $this->jsonResponse(['message' => 'הסרטון נוסף בהצלחה', 'video' => $video], 201);

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה סרטון'], 400);
                }

                $video = $this->db->fetchOne('SELECT * FROM profile_videos WHERE id = ?', [$id]);
                if (!$video) {
                    return $this->jsonResponse(['error' => 'סרטון לא נמצא'], 404);
                }

                $urlPath = parse_url($video['video_url'], PHP_URL_PATH);
                $filePath = realpath(BASE_PATH . $urlPath);
                $uploadDir = realpath(BASE_PATH . '/public/uploads');
                if ($filePath && $uploadDir && strpos($filePath, $uploadDir) === 0 && file_exists($filePath)) {
                    unlink($filePath);
                }

                $this->db->execute('DELETE FROM profile_videos WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'הסרטון נמחק בהצלחה']);
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה סרטון'], 400);
                }
                $data = $this->getJson();
                $title = trim($data['title'] ?? '');
                $this->db->execute('UPDATE profile_videos SET title = ? WHERE id = ?', [$title, $id]);
                $this->jsonResponse(['message' => 'הסרטון עודכן']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Admin: Users
    // ========================

    private function adminUsers($id, $method) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $user = $this->db->fetchOne('SELECT id, name, email, phone, vip_level, created_at FROM users WHERE id = ?', [$id]);
                    if (!$user) {
                        return $this->jsonResponse(['error' => 'משתמש לא נמצא'], 404);
                    }
                    $this->jsonResponse($user);
                } else {
                    $page = max(1, intval($_GET['page'] ?? 1));
                    $perPage = max(1, min(100, intval($_GET['per_page'] ?? 20)));
                    $offset = ($page - 1) * $perPage;

                    $countResult = $this->db->fetchOne('SELECT COUNT(*) as total FROM users');
                    $total = $countResult['total'] ?? 0;

                    $users = $this->db->fetchAll(
                        'SELECT id, name, email, phone, vip_level, created_at FROM users ORDER BY created_at DESC LIMIT ? OFFSET ?',
                        [$perPage, $offset]
                    );

                    $this->jsonResponse([
                        'users' => $users,
                        'total' => intval($total),
                        'page' => $page,
                        'per_page' => $perPage,
                        'total_pages' => ceil($total / $perPage)
                    ]);
                }
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה משתמש'], 400);
                }
                $data = $this->getJson();
                $fields = [];
                $params = [];

                $allowedFields = ['name', 'email', 'phone', 'vip_level'];
                foreach ($allowedFields as $field) {
                    if (isset($data[$field])) {
                        $fields[] = "$field = ?";
                        $params[] = $data[$field];
                    }
                }

                if (isset($data['password']) && !empty($data['password'])) {
                    $fields[] = 'password = ?';
                    $params[] = $this->hashPassword($data['password']);
                }

                if (empty($fields)) {
                    return $this->jsonResponse(['error' => 'לא נשלחו שדות לעדכון'], 400);
                }

                $params[] = $id;
                $this->db->execute('UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = ?', $params);

                $user = $this->db->fetchOne('SELECT id, name, email, phone, vip_level, created_at FROM users WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'המשתמש עודכן בהצלחה', 'user' => $user]);
                break;

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה משתמש'], 400);
                }
                $this->db->execute('DELETE FROM users WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'המשתמש נמחק בהצלחה']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Admin: Messages
    // ========================

    private function adminMessages($id, $method) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $message = $this->db->fetchOne('SELECT * FROM messages WHERE id = ?', [$id]);
                    if (!$message) {
                        return $this->jsonResponse(['error' => 'הודעה לא נמצאה'], 404);
                    }
                    // Mark as read
                    $this->db->execute('UPDATE messages SET is_read = TRUE WHERE id = ?', [$id]);
                    $message['is_read'] = true;
                    $this->jsonResponse($message);
                } else {
                    $page = max(1, intval($_GET['page'] ?? 1));
                    $perPage = max(1, min(100, intval($_GET['per_page'] ?? 20)));
                    $offset = ($page - 1) * $perPage;

                    $countResult = $this->db->fetchOne('SELECT COUNT(*) as total FROM messages');
                    $total = $countResult['total'] ?? 0;

                    $messages = $this->db->fetchAll(
                        'SELECT * FROM messages ORDER BY created_at DESC LIMIT ? OFFSET ?',
                        [$perPage, $offset]
                    );

                    $this->jsonResponse([
                        'messages' => $messages,
                        'total' => intval($total),
                        'page' => $page,
                        'per_page' => $perPage,
                        'total_pages' => ceil($total / $perPage)
                    ]);
                }
                break;

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה הודעה'], 400);
                }
                $this->db->execute('DELETE FROM messages WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'ההודעה נמחקה בהצלחה']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Admin: Leads
    // ========================

    private function adminLeads($id, $method) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $lead = $this->db->fetchOne('SELECT * FROM leads WHERE id = ?', [$id]);
                    if (!$lead) {
                        return $this->jsonResponse(['error' => 'ליד לא נמצא'], 404);
                    }
                    $this->jsonResponse($lead);
                } else {
                    $page = max(1, intval($_GET['page'] ?? 1));
                    $perPage = max(1, min(100, intval($_GET['per_page'] ?? 20)));
                    $offset = ($page - 1) * $perPage;

                    $countResult = $this->db->fetchOne('SELECT COUNT(*) as total FROM leads');
                    $total = $countResult['total'] ?? 0;

                    $leads = $this->db->fetchAll(
                        'SELECT * FROM leads ORDER BY created_at DESC LIMIT ? OFFSET ?',
                        [$perPage, $offset]
                    );

                    $this->jsonResponse([
                        'leads' => $leads,
                        'total' => intval($total),
                        'page' => $page,
                        'per_page' => $perPage,
                        'total_pages' => ceil($total / $perPage)
                    ]);
                }
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה ליד'], 400);
                }
                $data = $this->getJson();
                $fields = [];
                $params = [];

                $allowedFields = ['name', 'email', 'phone', 'message', 'status', 'source', 'package_type'];
                foreach ($allowedFields as $field) {
                    if (isset($data[$field])) {
                        $fields[] = "$field = ?";
                        $params[] = $data[$field];
                    }
                }

                if (empty($fields)) {
                    return $this->jsonResponse(['error' => 'לא נשלחו שדות לעדכון'], 400);
                }

                $params[] = $id;
                $this->db->execute('UPDATE leads SET ' . implode(', ', $fields) . ' WHERE id = ?', $params);

                $lead = $this->db->fetchOne('SELECT * FROM leads WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'הליד עודכן בהצלחה', 'lead' => $lead]);
                break;

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה ליד'], 400);
                }
                $this->db->execute('DELETE FROM leads WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'הליד נמחק בהצלחה']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Admin: Pages
    // ========================

    private function adminPages($id, $method) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $page = $this->db->fetchOne('SELECT * FROM pages WHERE id = ?', [$id]);
                    if (!$page) {
                        return $this->jsonResponse(['error' => 'דף לא נמצא'], 404);
                    }
                    $this->jsonResponse($page);
                } else {
                    $pages = $this->db->fetchAll('SELECT * FROM pages ORDER BY created_at DESC');
                    $this->jsonResponse($pages);
                }
                break;

            case 'POST':
                $data = $this->getJson();
                $title = trim($data['title'] ?? '');
                $slug = trim($data['slug'] ?? '');
                $content = trim($data['content'] ?? '');
                $metaTitle = trim($data['meta_title'] ?? '');
                $metaDescription = trim($data['meta_description'] ?? '');
                $isActive = isset($data['is_active']) ? (bool)$data['is_active'] : true;

                if (!$title || !$slug) {
                    return $this->jsonResponse(['error' => 'כותרת ו-slug הם שדות חובה'], 400);
                }

                $existing = $this->db->fetchOne('SELECT id FROM pages WHERE slug = ?', [$slug]);
                if ($existing) {
                    return $this->jsonResponse(['error' => 'slug כבר קיים במערכת'], 400);
                }

                $this->db->insert('pages', [
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'meta_title' => $metaTitle,
                    'meta_description' => $metaDescription,
                    'is_active' => $isActive,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $newPage = $this->db->fetchOne('SELECT * FROM pages ORDER BY id DESC LIMIT 1');
                $this->jsonResponse(['message' => 'הדף נוצר בהצלחה', 'page' => $newPage], 201);
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה דף'], 400);
                }
                $data = $this->getJson();
                $fields = [];
                $params = [];

                $allowedFields = ['title', 'slug', 'content', 'meta_title', 'meta_description', 'is_active'];
                foreach ($allowedFields as $field) {
                    if (isset($data[$field])) {
                        $fields[] = "$field = ?";
                        $params[] = $data[$field];
                    }
                }

                if (empty($fields)) {
                    return $this->jsonResponse(['error' => 'לא נשלחו שדות לעדכון'], 400);
                }

                $params[] = $id;
                $this->db->execute('UPDATE pages SET ' . implode(', ', $fields) . ' WHERE id = ?', $params);

                $page = $this->db->fetchOne('SELECT * FROM pages WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'הדף עודכן בהצלחה', 'page' => $page]);
                break;

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה דף'], 400);
                }
                $this->db->execute('DELETE FROM pages WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'הדף נמחק בהצלחה']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Admin: Stories
    // ========================

    private function adminStories($id, $method) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $story = $this->db->fetchOne('SELECT * FROM success_stories WHERE id = ?', [$id]);
                    if (!$story) {
                        return $this->jsonResponse(['error' => 'סיפור לא נמצא'], 404);
                    }
                    $this->jsonResponse($story);
                } else {
                    $stories = $this->db->fetchAll('SELECT * FROM success_stories ORDER BY created_at DESC');
                    $this->jsonResponse($stories);
                }
                break;

            case 'POST':
                $data = $this->getJson();
                $title = trim($data['title'] ?? '');
                $coupleNames = trim($data['couple_names'] ?? '');
                $story = trim($data['story'] ?? '');
                $imageUrl = trim($data['image_url'] ?? '');
                $weddingDate = trim($data['wedding_date'] ?? '');
                $isActive = isset($data['is_active']) ? (bool)$data['is_active'] : true;

                if (!$title || !$story) {
                    return $this->jsonResponse(['error' => 'כותרת וסיפור הם שדות חובה'], 400);
                }

                $this->db->insert('success_stories', [
                    'title' => $title,
                    'couple_names' => $coupleNames,
                    'story' => $story,
                    'image_url' => $imageUrl,
                    'wedding_date' => $weddingDate ?: null,
                    'is_active' => $isActive,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $newStory = $this->db->fetchOne('SELECT * FROM success_stories ORDER BY id DESC LIMIT 1');
                $this->jsonResponse(['message' => 'הסיפור נוצר בהצלחה', 'story' => $newStory], 201);
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה סיפור'], 400);
                }
                $data = $this->getJson();
                $fields = [];
                $params = [];

                $allowedFields = ['title', 'couple_names', 'story', 'image_url', 'wedding_date', 'is_active'];
                foreach ($allowedFields as $field) {
                    if (isset($data[$field])) {
                        $fields[] = "$field = ?";
                        $params[] = $data[$field];
                    }
                }

                if (empty($fields)) {
                    return $this->jsonResponse(['error' => 'לא נשלחו שדות לעדכון'], 400);
                }

                $params[] = $id;
                $this->db->execute('UPDATE success_stories SET ' . implode(', ', $fields) . ' WHERE id = ?', $params);

                $story = $this->db->fetchOne('SELECT * FROM success_stories WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'הסיפור עודכן בהצלחה', 'story' => $story]);
                break;

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה סיפור'], 400);
                }
                $this->db->execute('DELETE FROM success_stories WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'הסיפור נמחק בהצלחה']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Admin: FAQs
    // ========================

    private function adminFaqs($id, $method) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $faq = $this->db->fetchOne('SELECT * FROM faqs WHERE id = ?', [$id]);
                    if (!$faq) {
                        return $this->jsonResponse(['error' => 'שאלה לא נמצאה'], 404);
                    }
                    $this->jsonResponse($faq);
                } else {
                    $faqs = $this->db->fetchAll('SELECT * FROM faqs ORDER BY sort_order ASC, id ASC');
                    $this->jsonResponse($faqs);
                }
                break;

            case 'POST':
                $data = $this->getJson();
                $question = trim($data['question'] ?? '');
                $answer = trim($data['answer'] ?? '');
                $sortOrder = intval($data['sort_order'] ?? 0);
                $isActive = isset($data['is_active']) ? (bool)$data['is_active'] : true;

                if (!$question || !$answer) {
                    return $this->jsonResponse(['error' => 'שאלה ותשובה הם שדות חובה'], 400);
                }

                $this->db->insert('faqs', [
                    'question' => $question,
                    'answer' => $answer,
                    'sort_order' => $sortOrder,
                    'is_active' => $isActive,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $newFaq = $this->db->fetchOne('SELECT * FROM faqs ORDER BY id DESC LIMIT 1');
                $this->jsonResponse(['message' => 'השאלה נוצרה בהצלחה', 'faq' => $newFaq], 201);
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה שאלה'], 400);
                }
                $data = $this->getJson();
                $fields = [];
                $params = [];

                $allowedFields = ['question', 'answer', 'sort_order', 'is_active'];
                foreach ($allowedFields as $field) {
                    if (isset($data[$field])) {
                        $fields[] = "$field = ?";
                        $params[] = $data[$field];
                    }
                }

                if (empty($fields)) {
                    return $this->jsonResponse(['error' => 'לא נשלחו שדות לעדכון'], 400);
                }

                $params[] = $id;
                $this->db->execute('UPDATE faqs SET ' . implode(', ', $fields) . ' WHERE id = ?', $params);

                $faq = $this->db->fetchOne('SELECT * FROM faqs WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'השאלה עודכנה בהצלחה', 'faq' => $faq]);
                break;

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה שאלה'], 400);
                }
                $this->db->execute('DELETE FROM faqs WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'השאלה נמחקה בהצלחה']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Admin: Reviews
    // ========================

    private function adminReviews($id, $method) {
        switch ($method) {
            case 'GET':
                $reviews = $this->db->fetchAll('SELECT * FROM reviews ORDER BY id DESC');
                $this->jsonResponse($reviews);
                break;
            case 'POST':
                $data = $this->getJson();
                $this->db->insert('reviews', [
                    'client_name' => trim($data['client_name'] ?? ''),
                    'client_photo' => trim($data['client_photo'] ?? ''),
                    'rating' => intval($data['rating'] ?? 5),
                    'review_text' => trim($data['review_text'] ?? ''),
                    'is_active' => true,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                $review = $this->db->fetchOne('SELECT * FROM reviews ORDER BY id DESC LIMIT 1');
                $this->jsonResponse(['message' => 'ביקורת נוספה', 'review' => $review], 201);
                break;
            case 'PUT':
                if (!$id) return $this->jsonResponse(['error' => 'נדרש מזהה'], 400);
                $data = $this->getJson();
                $fields = []; $params = [];
                foreach (['client_name','client_photo','rating','review_text','is_active'] as $f) {
                    if (isset($data[$f])) { $fields[] = "$f = ?"; $params[] = $data[$f]; }
                }
                if ($fields) { $params[] = $id; $this->db->execute('UPDATE reviews SET ' . implode(', ', $fields) . ' WHERE id = ?', $params); }
                $this->jsonResponse(['message' => 'ביקורת עודכנה']);
                break;
            case 'DELETE':
                if (!$id) return $this->jsonResponse(['error' => 'נדרש מזהה'], 400);
                $this->db->execute('DELETE FROM reviews WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'ביקורת נמחקה']);
                break;
            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Admin: Process Steps
    // ========================

    private function adminProcessSteps($id, $method) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $step = $this->db->fetchOne('SELECT * FROM process_steps WHERE id = ?', [$id]);
                    if (!$step) {
                        return $this->jsonResponse(['error' => 'שלב לא נמצא'], 404);
                    }
                    $this->jsonResponse($step);
                } else {
                    $steps = $this->db->fetchAll('SELECT * FROM process_steps ORDER BY step_number ASC');
                    $this->jsonResponse($steps);
                }
                break;

            case 'POST':
                $data = $this->getJson();
                $stepNumber = intval($data['step_number'] ?? 0);
                $title = trim($data['title'] ?? '');
                $description = trim($data['description'] ?? '');
                $icon = trim($data['icon'] ?? '');

                if (!$stepNumber || !$title) {
                    return $this->jsonResponse(['error' => 'מספר שלב וכותרת הם שדות חובה'], 400);
                }

                $imageUrl = trim($data['image_url'] ?? '');
                $isActive = isset($data['is_active']) ? (bool)$data['is_active'] : true;
                $this->db->insert('process_steps', [
                    'step_number' => $stepNumber,
                    'title' => $title,
                    'description' => $description,
                    'icon' => $icon,
                    'image_url' => $imageUrl ?: null,
                    'is_active' => $isActive,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $newStep = $this->db->fetchOne('SELECT * FROM process_steps ORDER BY id DESC LIMIT 1');
                $this->jsonResponse(['message' => 'השלב נוצר בהצלחה', 'step' => $newStep], 201);
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה שלב'], 400);
                }
                $data = $this->getJson();
                $fields = [];
                $params = [];

                $allowedFields = ['step_number', 'title', 'description', 'icon', 'image_url', 'is_active'];
                foreach ($allowedFields as $field) {
                    if (isset($data[$field])) {
                        $fields[] = "$field = ?";
                        $params[] = $data[$field];
                    }
                }

                if (empty($fields)) {
                    return $this->jsonResponse(['error' => 'לא נשלחו שדות לעדכון'], 400);
                }

                $params[] = $id;
                $this->db->execute('UPDATE process_steps SET ' . implode(', ', $fields) . ' WHERE id = ?', $params);

                $step = $this->db->fetchOne('SELECT * FROM process_steps WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'השלב עודכן בהצלחה', 'step' => $step]);
                break;

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה שלב'], 400);
                }
                $this->db->execute('DELETE FROM process_steps WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'השלב נמחק בהצלחה']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    // ========================
    // Public: Page Blocks
    // ========================

    private function getPageBlocks() {
        $pageSlug = trim($_GET['page'] ?? '');
        if (!$pageSlug) {
            return $this->jsonResponse([]);
        }
        $blocks = $this->db->fetchAll(
            'SELECT * FROM page_blocks WHERE page_slug = ? AND is_active = 1 ORDER BY sort_order ASC',
            [$pageSlug]
        );
        // Decode block_data JSON
        foreach ($blocks as &$b) {
            $b['block_data'] = json_decode($b['block_data'], true);
        }
        $this->jsonResponse($blocks);
    }

    // ========================
    // Admin: Page Blocks
    // ========================

    private function adminBlocks($id, $method) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $block = $this->db->fetchOne('SELECT * FROM page_blocks WHERE id = ?', [$id]);
                    if (!$block) {
                        return $this->jsonResponse(['error' => 'בלוק לא נמצא'], 404);
                    }
                    $block['block_data'] = json_decode($block['block_data'], true);
                    $this->jsonResponse($block);
                } else {
                    $pageSlug = trim($_GET['page'] ?? '');
                    $where = $pageSlug ? 'WHERE page_slug = ?' : '';
                    $params = $pageSlug ? [$pageSlug] : [];
                    $blocks = $this->db->fetchAll(
                        "SELECT * FROM page_blocks $where ORDER BY sort_order ASC",
                        $params
                    );
                    foreach ($blocks as &$b) {
                        $b['block_data'] = json_decode($b['block_data'], true);
                    }
                    $this->jsonResponse($blocks);
                }
                break;

            case 'POST':
                $data = $this->getJson();
                $pageSlug = trim($data['page_slug'] ?? '');
                $blockType = trim($data['block_type'] ?? '');
                $blockData = $data['block_data'] ?? [];
                $insertAfter = isset($data['insert_after']) ? intval($data['insert_after']) : null;

                if (!$pageSlug || !$blockType) {
                    return $this->jsonResponse(['error' => 'page_slug ו block_type הם שדות חובה'], 400);
                }

                // Auto sort_order: next available
                $maxOrder = $this->db->fetchOne(
                    'SELECT COALESCE(MAX(sort_order), -1) as max_order FROM page_blocks WHERE page_slug = ?',
                    [$pageSlug]
                );
                $sortOrder = intval($data['sort_order'] ?? ($maxOrder['max_order'] + 1));

                $this->db->insert('page_blocks', [
                    'page_slug' => $pageSlug,
                    'block_type' => $blockType,
                    'block_data' => json_encode($blockData, JSON_UNESCAPED_UNICODE),
                    'sort_order' => $sortOrder,
                    'insert_after' => $insertAfter,
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $newBlock = $this->db->fetchOne('SELECT * FROM page_blocks ORDER BY id DESC LIMIT 1');
                $newBlock['block_data'] = json_decode($newBlock['block_data'], true);
                $this->jsonResponse(['message' => 'בלוק נוסף בהצלחה', 'block' => $newBlock], 201);
                break;

            case 'PUT':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה בלוק'], 400);
                }
                $data = $this->getJson();
                $fields = [];
                $params = [];

                if (isset($data['block_data'])) {
                    $fields[] = 'block_data = ?';
                    $params[] = json_encode($data['block_data'], JSON_UNESCAPED_UNICODE);
                }
                if (isset($data['block_type'])) {
                    $fields[] = 'block_type = ?';
                    $params[] = $data['block_type'];
                }
                if (isset($data['sort_order'])) {
                    $fields[] = 'sort_order = ?';
                    $params[] = intval($data['sort_order']);
                }
                if (isset($data['insert_after'])) {
                    $fields[] = 'insert_after = ?';
                    $params[] = $data['insert_after'] !== null ? intval($data['insert_after']) : null;
                }
                if (isset($data['is_active'])) {
                    $fields[] = 'is_active = ?';
                    $params[] = (int)(bool)$data['is_active'];
                }

                if (empty($fields)) {
                    return $this->jsonResponse(['error' => 'לא נשלחו שדות לעדכון'], 400);
                }

                $params[] = $id;
                $this->db->execute('UPDATE page_blocks SET ' . implode(', ', $fields) . ' WHERE id = ?', $params);

                $block = $this->db->fetchOne('SELECT * FROM page_blocks WHERE id = ?', [$id]);
                $block['block_data'] = json_decode($block['block_data'], true);
                $this->jsonResponse(['message' => 'בלוק עודכן בהצלחה', 'block' => $block]);
                break;

            case 'DELETE':
                if (!$id) {
                    return $this->jsonResponse(['error' => 'נדרש מזהה בלוק'], 400);
                }
                $this->db->execute('DELETE FROM page_blocks WHERE id = ?', [$id]);
                $this->jsonResponse(['message' => 'בלוק נמחק בהצלחה']);
                break;

            default:
                $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
    }

    private function adminBlocksReorder() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->jsonResponse(['error' => 'Method not allowed'], 405);
        }
        $data = $this->getJson();
        $orders = $data['orders'] ?? [];
        if (empty($orders)) {
            return $this->jsonResponse(['error' => 'לא נשלחו נתונים'], 400);
        }
        foreach ($orders as $item) {
            $id = intval($item['id'] ?? 0);
            $sortOrder = intval($item['sort_order'] ?? 0);
            $insertAfter = isset($item['insert_after']) ? ($item['insert_after'] !== null ? intval($item['insert_after']) : null) : null;
            if ($id) {
                if ($insertAfter !== null) {
                    $this->db->execute('UPDATE page_blocks SET sort_order = ?, insert_after = ? WHERE id = ?', [$sortOrder, $insertAfter, $id]);
                } else {
                    $this->db->execute('UPDATE page_blocks SET sort_order = ? WHERE id = ?', [$sortOrder, $id]);
                }
            }
        }
        $this->jsonResponse(['message' => 'סדר הבלוקים עודכן בהצלחה']);
    }
}
