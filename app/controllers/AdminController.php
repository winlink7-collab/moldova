<?php
class AdminController {
    public function index() {
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            $pageTitle = 'כניסת מנהל - Moldova & Ukraine';
            require BASE_PATH . '/app/views/admin/login.php';
            return;
        }
        $pageTitle = 'פאנל ניהול - Moldova & Ukraine';
        require BASE_PATH . '/app/views/admin/index.php';
    }
}
