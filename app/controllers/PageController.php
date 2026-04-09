<?php
class PageController {
    public function about() {
        $pageTitle = 'אודות - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'הכירו את סוכנות השידוכים הבינלאומית המובילה - מובילים את עולם השידוכים עם סטנדרטים של יוקרה ודיסקרטיות';
        $currentPage = 'about';
        $isAdmin = !empty($_SESSION['admin_logged_in']);
        require BASE_PATH . '/app/views/about/index.php';
    }

    public function search() {
        $pageTitle = 'חיפוש פרופילים - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'חפשו בין מאות פרופילים מאומתים של נשים יפות ומשכילות ממולדובה ואוקראינה';
        $currentPage = 'search';
        $isAdmin = !empty($_SESSION['admin_logged_in']);
        require BASE_PATH . '/app/views/search/index.php';
    }

    public function stories() {
        $pageTitle = 'סיפורי הצלחה - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'קראו סיפורי הצלחה מרגשים של זוגות שמצאו אהבת אמת דרך שירות השידוכים היוקרתי שלנו';
        $currentPage = 'stories';
        $isAdmin = !empty($_SESSION['admin_logged_in']);
        require BASE_PATH . '/app/views/stories/index.php';
    }

    public function process() {
        $pageTitle = 'תהליך השידוך - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'גלו את תהליך השידוך האקסקלוסיבי שלנו - 5 שלבים למציאת אהבת אמת ממולדובה ואוקראינה';
        $currentPage = 'process';
        $isAdmin = !empty($_SESSION['admin_logged_in']);
        require BASE_PATH . '/app/views/process/index.php';
    }

    public function faq() {
        $pageTitle = 'שאלות נפוצות - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'תשובות לשאלות נפוצות בנושא שירותי השידוכים היוקרתיים שלנו - אימות פרופילים, דיסקרטיות ועוד';
        $currentPage = 'faq';
        $isAdmin = !empty($_SESSION['admin_logged_in']);
        require BASE_PATH . '/app/views/faq/index.php';
    }

    public function contact() {
        $pageTitle = 'צרו קשר - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'צרו קשר עם צוות שידוכי היוקרה שלנו - ייעוץ אישי, שירות VIP ומענה מקצועי';
        $currentPage = 'contact';
        $isAdmin = !empty($_SESSION['admin_logged_in']);
        require BASE_PATH . '/app/views/contact/index.php';
    }

    public function vip() {
        $pageTitle = 'חבילות VIP - Moldova & Ukraine Luxury Brides';
        $pageDescription = 'חבילות VIP אקסקלוסיביות לשירות שידוכים יוקרתי - Silver, Gold ו-Diamond';
        $currentPage = 'vip';
        $isAdmin = !empty($_SESSION['admin_logged_in']);
        require BASE_PATH . '/app/views/vip/index.php';
    }

    public function customPage($slug) {
        $db = Database::getInstance();
        $page = $db->fetchOne('SELECT * FROM pages WHERE slug = ? AND is_active = TRUE', [$slug]);
        if (!$page) {
            http_response_code(404);
            echo '<h1>דף לא נמצא</h1>';
            return;
        }
        $pageTitle = ($page['meta_title'] ?: $page['title']) . ' - Moldova & Ukraine';
        $pageDescription = $page['meta_description'] ?: '';
        $currentPage = 'page';
        $customPage = $page;
        $isAdmin = !empty($_SESSION['admin_logged_in']);
        require BASE_PATH . '/app/views/page/index.php';
    }
}
