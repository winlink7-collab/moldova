<?php
/**
 * One-time setup script - creates config/mail.local.php on server
 * Delete this file after running!
 */
header('Content-Type: text/html; charset=utf-8');

$configPath = __DIR__ . '/config/mail.local.php';
$apiKey = $_GET['key'] ?? '';
$fromEmail = $_GET['from'] ?? '';

if (!$apiKey || !$fromEmail) {
    echo '<!DOCTYPE html><html><body style="font-family:Arial;padding:40px;">';
    echo '<h2>Setup Mail Config</h2>';
    echo '<form method="GET">';
    echo '<p><label>SendGrid API Key:</label><br><input name="key" size="80" required/></p>';
    echo '<p><label>From Email:</label><br><input name="from" type="email" value="winlink7@gmail.com" size="40" required/></p>';
    echo '<p><button type="submit" style="padding:10px 20px;background:#f2d00d;border:none;border-radius:6px;font-weight:bold;cursor:pointer;">Create Config</button></p>';
    echo '</form>';
    echo '</body></html>';
    exit;
}

$content = "<?php\n";
$content .= "define('SENDGRID_API_KEY', '" . addslashes($apiKey) . "');\n";
$content .= "define('SENDGRID_FROM_EMAIL', '" . addslashes($fromEmail) . "');\n";

if (file_put_contents($configPath, $content)) {
    echo '<div style="font-family:Arial;padding:40px;">';
    echo '<h2 style="color:green;">✓ Config created successfully!</h2>';
    echo '<p>File: ' . $configPath . '</p>';
    echo '<p><strong>IMPORTANT:</strong> Delete this file (setup_mail.php) now for security!</p>';
    echo '<p><a href="/">Go to homepage</a></p>';
    echo '</div>';
} else {
    echo '<div style="color:red;font-family:Arial;padding:40px;">';
    echo '<h2>Failed to create file</h2>';
    echo '<p>Check directory permissions.</p>';
    echo '</div>';
}
