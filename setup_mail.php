<?php
header('Content-Type: text/html; charset=utf-8');

$configPath = __DIR__ . '/config/mail.local.php';
$apiKey = $_GET['key'] ?? '';
$fromEmail = $_GET['from'] ?? '';

if (!$apiKey || !$fromEmail) {
    echo '<!DOCTYPE html><html><body style="font-family:Arial;padding:40px;background:#f5f5f5;">';
    echo '<h2>Setup Mail Config</h2>';
    echo '<form method="POST" action="?submit=1">';
    echo '<p><label>SendGrid API Key (full, starts with SG.):</label><br><input name="key" style="width:100%;padding:8px;" required/></p>';
    echo '<p><label>From Email:</label><br><input name="from" type="email" value="winlink7@gmail.com" style="width:100%;padding:8px;" required/></p>';
    echo '<p><button type="submit" style="padding:12px 30px;background:#f2d00d;border:none;border-radius:6px;font-weight:bold;cursor:pointer;">Save</button></p>';
    echo '</form>';
    echo '</body></html>';
    exit;
}

if (isset($_GET['submit'])) {
    $apiKey = $_POST['key'] ?? '';
    $fromEmail = $_POST['from'] ?? '';
}

$content = "<?php\n";
$content .= "define('SENDGRID_API_KEY', '" . addslashes($apiKey) . "');\n";
$content .= "define('SENDGRID_FROM_EMAIL', '" . addslashes($fromEmail) . "');\n";

if (file_put_contents($configPath, $content)) {
    echo '<div style="font-family:Arial;padding:40px;">';
    echo '<h2 style="color:green;">✓ Config saved!</h2>';
    echo '<p>Key: ' . substr($apiKey, 0, 15) . '...' . substr($apiKey, -5) . '</p>';
    echo '<p>Length: ' . strlen($apiKey) . ' chars</p>';
    echo '<p><a href="/check-mail">Verify</a></p>';
    echo '</div>';
} else {
    echo '<h2 style="color:red;">Failed to write file</h2>';
}
