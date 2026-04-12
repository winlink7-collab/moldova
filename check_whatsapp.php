<?php
header('Content-Type: text/plain; charset=utf-8');
require_once __DIR__ . '/config/whatsapp.local.php';

$idInstance = defined('GREEN_API_ID_INSTANCE') ? GREEN_API_ID_INSTANCE : '';
$apiToken = defined('GREEN_API_TOKEN') ? GREEN_API_TOKEN : '';

echo "ID Instance: " . substr($idInstance, 0, 6) . "...\n";
echo "API Token: " . substr($apiToken, 0, 10) . "...\n\n";

// Check account state
$url = "https://api.green-api.com/waInstance{$idInstance}/getStateInstance/{$apiToken}";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "=== Account State ===\n";
echo "HTTP: $httpCode\n";
echo "Response: $response\n\n";

// Get settings
$url = "https://api.green-api.com/waInstance{$idInstance}/getSettings/{$apiToken}";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "=== Settings ===\n";
echo "HTTP: $httpCode\n";
echo "Response: $response\n";
