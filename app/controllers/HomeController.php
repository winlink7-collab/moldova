<?php
class HomeController {
    public function index() {
        $pageTitle = 'Moldova & Ukraine Luxury Brides - שידוכי יוקרה';
        $pageDescription = 'שירות שידוכי יוקרה בינלאומי - מחברים בין גברים מצליחים לנשים היפות והמשכילות ביותר ממולדובה ואוקראינה';
        $currentPage = 'home';
        $isAdmin = !empty($_SESSION['admin_logged_in']) || !empty($_COOKIE['admin_token']);
        require BASE_PATH . '/app/views/home/index.php';
    }
}
