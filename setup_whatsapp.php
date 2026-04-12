<?php
header('Content-Type: text/html; charset=utf-8');

$configPath = __DIR__ . '/config/whatsapp.local.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idInstance = trim($_POST['id_instance'] ?? '');
    $apiToken = trim($_POST['api_token'] ?? '');

    if ($idInstance && $apiToken) {
        $content = "<?php\n";
        $content .= "define('GREEN_API_ID_INSTANCE', '" . addslashes($idInstance) . "');\n";
        $content .= "define('GREEN_API_TOKEN', '" . addslashes($apiToken) . "');\n";

        if (file_put_contents($configPath, $content)) {
            echo '<div style="font-family:Arial;padding:40px;background:#f5f5f5;">';
            echo '<h2 style="color:green;">✓ WhatsApp Config Saved!</h2>';
            echo '<p>idInstance: ' . htmlspecialchars(substr($idInstance, 0, 5)) . '...</p>';
            echo '<p>apiTokenInstance: ' . htmlspecialchars(substr($apiToken, 0, 10)) . '...</p>';
            echo '<p><strong>Next:</strong> Run SQL to create whatsapp_otps table</p>';
            echo '<p>Then test: /test-whatsapp</p>';
            echo '</div>';
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html dir="rtl">
<head><meta charset="utf-8"><title>Setup WhatsApp</title></head>
<body style="font-family:Arial;padding:40px;background:#f5f5f5;">
<h2>Setup WhatsApp (Green-API)</h2>
<p>קבל את הפרטים מ: <a href="https://console.green-api.com/" target="_blank">console.green-api.com</a></p>
<form method="POST">
    <p>
        <label><strong>idInstance:</strong></label><br>
        <input name="id_instance" style="width:100%;padding:10px;" placeholder="1101234567" required/>
    </p>
    <p>
        <label><strong>apiTokenInstance:</strong></label><br>
        <input name="api_token" style="width:100%;padding:10px;" placeholder="d75b098..." required/>
    </p>
    <p>
        <button type="submit" style="padding:12px 30px;background:#25D366;color:white;border:none;border-radius:6px;font-weight:bold;cursor:pointer;font-size:16px;">Save</button>
    </p>
</form>
</body>
</html>
