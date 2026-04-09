<?php
class AdminController {
    public function index() {
        if (empty($_SESSION['admin_logged_in']) && empty($_COOKIE['admin_token'])) {
            $pageTitle = 'כניסת מנהל - Moldova & Ukraine';
            require BASE_PATH . '/app/views/admin/login.php';
            return;
        }
        $pageTitle = 'פאנל ניהול - Moldova & Ukraine';
        require BASE_PATH . '/app/views/admin/index.php';
    }
}
