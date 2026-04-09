<?php
class ProfileController {
    public function show($id) {
        $pageTitle = 'פרופיל - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'צפו בפרופיל מאומת של מועמדת לשידוך יוקרתי';
        $currentPage = 'search';
        $profileId = $id;
        $isAdmin = !empty($_SESSION['admin_logged_in']) || !empty($_COOKIE['admin_token']);
        require BASE_PATH . '/app/views/profile/show.php';
    }
}
