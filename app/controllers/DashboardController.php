<?php
class DashboardController {
    public function index() {
        $pageTitle = 'האזור האישי - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'ניהול חשבון אישי - Moldova & Ukraine Luxury Brides';
        $currentPage = 'dashboard';
        $isAdmin = !empty($_SESSION['admin_logged_in']);
        require BASE_PATH . '/app/views/dashboard/index.php';
    }
}
