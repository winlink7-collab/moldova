<?php
class AuthController {
    public function loginPage() {
        $pageTitle = 'התחברות - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'כניסה לחשבון VIP - Moldova & Ukraine Luxury Brides';
        $currentPage = 'login';
        require BASE_PATH . '/app/views/login/index.php';
    }
}
