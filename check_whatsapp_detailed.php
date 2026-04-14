<?php
header('Content-Type: text/plain; charset=utf-8');
require_once __DIR__ . '/config/whatsapp.local.php';

$idInstance = GREEN_API_ID_INSTANCE;
$apiToken = GREEN_API_TOKEN;

echo "=== Green-API Status ===\n\n";

// Check if number has WhatsApp
$phone = $_GET['phone'] ?? '972585311286';
$phone = preg_replace('/[^\d]/', '', $phone);

$url = "https://api.green-api.com/waInstance{$idInstance}/checkWhatsapp/{$apiToken}";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['phoneNumber' => $phone]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);
curl_close($ch);

echo "Checking if $phone has WhatsApp:\n";
echo $response . "\n\n";

// Get outgoing queue
$url = "https://api.green-api.com/waInstance{$idInstance}/showMessagesQueue/{$apiToken}";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$queueResp = curl_exec($ch);
curl_close($ch);

echo "=== Outgoing Queue ===\n";
echo $queueResp . "\n\n";

// Account state
$url = "https://api.green-api.com/waInstance{$idInstance}/getStateInstance/{$apiToken}";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$stateResp = curl_exec($ch);
curl_close($ch);

echo "=== State ===\n";
echo $stateResp . "\n";
