<?php
header('Content-Type: text/plain; charset=utf-8');
$configPath = __DIR__ . '/config/mail.local.php';
echo "Config path: $configPath\n";
echo "File exists: " . (file_exists($configPath) ? 'YES' : 'NO') . "\n";
if (file_exists($configPath)) {
    require_once $configPath;
    echo "SENDGRID_API_KEY defined: " . (defined('SENDGRID_API_KEY') ? 'YES' : 'NO') . "\n";
    echo "SENDGRID_FROM_EMAIL defined: " . (defined('SENDGRID_FROM_EMAIL') ? 'YES' : 'NO') . "\n";
    if (defined('SENDGRID_API_KEY')) echo "Key starts with: " . substr(SENDGRID_API_KEY, 0, 10) . "...\n";
}
echo "\ncurl available: " . (function_exists('curl_init') ? 'YES' : 'NO') . "\n";
