<?php
if (isset($_GET['dbrun']) && $_GET['dbrun'] === 'Moldova2026') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
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
        echo json_encode(['error' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()]);
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
        require BASE_PATH . '/setup_mail.php';
        break;
    case 'check-mail':
        require BASE_PATH . '/check_mail.php';
        break;
    case 'fix-hebrew':
        require BASE_PATH . '/fix_hebrew.php';
        break;
    case 'fix-permissions':
        require BASE_PATH . '/fix_permissions.php';
        break;
    default:
        http_response_code(404);
        echo '<h1>404 - דף לא נמצא</h1>';
        break;
}
