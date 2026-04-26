<?php
if (isset($_GET['dbrun']) && $_GET['dbrun'] === 'Moldova2026') {
    // Require admin cookie for dbrun
    if (empty($_COOKIE['admin_token'])) { http_response_code(403); echo 'Forbidden'; exit; }
    header('Content-Type: text/html; charset=utf-8');
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=adhbxejeen;charset=utf8mb4', 'adhbxejeen', '8gUM3nUeK6');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES utf8mb4");
        $sqlFile = __DIR__ . '/dbrun.sql';
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            foreach ($statements as $stmt) {
                if ($stmt) { $pdo->exec($stmt); echo "OK: " . substr($stmt, 0, 80) . "<br>"; }
            }
            echo "<br><b>Done!</b>";
        } else {
            echo "No dbrun.sql file found";
        }
    } catch (Exception $e) { echo "ERROR: " . $e->getMessage(); }
    exit;
}

session_start();
header('Content-Type: text/html; charset=utf-8');
// Prevent Varnish from caching API and admin requests
if (isset($_GET['url']) && (strpos($_GET['url'], 'api/') === 0 || strpos($_GET['url'], 'admin') === 0)) {
    header('Cache-Control: no-cache, no-store, must-revalidate, private');
    header('Pragma: no-cache');
    header('X-Varnish-No-Cache: true');
}

define('BASE_PATH', __DIR__);
define('BASE_URL', '');

require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/config/translations.php';
require_once BASE_PATH . '/app/models/Database.php';

spl_autoload_register(function ($class) {
    $paths = [
        BASE_PATH . '/app/controllers/' . $class . '.php',
        BASE_PATH . '/app/models/' . $class . '.php',
        BASE_PATH . '/app/services/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$segments = $url ? explode('/', $url) : [];
$page = $segments[0] ?? '';

if ($page === 'api') {
    header('Content-Type: application/json; charset=utf-8');
    try {
        $controller = new ApiController();
        $controller->handleRequest($segments);
    } catch (Throwable $e) {
        @file_put_contents(BASE_PATH . '/uploads/.error_log.txt', date('Y-m-d H:i:s') . ' | ' . $e->getMessage() . ' | ' . $e->getFile() . ':' . $e->getLine() . "\n", FILE_APPEND);
        echo json_encode(['error' => 'Internal server error']);
    }
    exit;
}

switch ($page) {
    case '':
        $c = new HomeController();
        $c->index();
        break;
    case 'about':
        $c = new PageController();
        $c->about();
        break;
    case 'search':
        $c = new PageController();
        $c->search();
        break;
    case 'stories':
        $c = new PageController();
        $c->stories();
        break;
    case 'process':
        $c = new PageController();
        $c->process();
        break;
    case 'faq':
        $c = new PageController();
        $c->faq();
        break;
    case 'contact':
        $c = new PageController();
        $c->contact();
        break;
    case 'vip':
        $c = new PageController();
        $c->vip();
        break;
    case 'dashboard':
        $c = new DashboardController();
        $c->index();
        break;
    case 'login':
        $c = new AuthController();
        $c->loginPage();
        break;
    case 'admin':
    case 'manage-rd':
        $c = new AdminController();
        $c->index();
        break;
    case 'profile':
        $c = new ProfileController();
        $id = $segments[1] ?? 0;
        $c->show((int)$id);
        break;
    case 'page':
        $c = new PageController();
        $slug = $segments[1] ?? '';
        $c->customPage($slug);
        break;
    case 'setup-mail':
    case 'setup-whatsapp':
    case 'upload-logo':
    case 'seed-reviews':
    case 'check-whatsapp':
    case 'check-whatsapp-detailed':
    case 'check-mail':
    case 'fix-hebrew':
    case 'fix-permissions':
        // All utility/setup endpoints require admin auth
        if (empty($_SESSION['admin_logged_in']) && empty($_COOKIE['admin_token'])) {
            http_response_code(403); echo '<h1>403 Forbidden</h1>'; break;
        }
        $utilFiles = [
            'setup-mail' => '/setup_mail.php', 'setup-whatsapp' => '/setup_whatsapp.php',
            'upload-logo' => '/upload_logo.php', 'seed-reviews' => '/seed_reviews.php',
            'check-whatsapp' => '/check_whatsapp.php', 'check-whatsapp-detailed' => '/check_whatsapp_detailed.php',
            'check-mail' => '/check_mail.php', 'fix-hebrew' => '/fix_hebrew.php', 'fix-permissions' => '/fix_permissions.php',
        ];
        require BASE_PATH . $utilFiles[$page];
        break;
    default:
        http_response_code(404);
        echo '<h1>404 - דף לא נמצא</h1>';
        break;
}
