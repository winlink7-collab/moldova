<?php
header('Content-Type: text/html; charset=utf-8');

$configPath = __DIR__ . '/config/mail.local.php';

// Handle POST submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apiKey = trim($_POST['key'] ?? '');
    $fromEmail = trim($_POST['from'] ?? '');

    if ($apiKey && $fromEmail) {
        $content = "<?php\n";
        $content .= "define('SENDGRID_API_KEY', '" . addslashes($apiKey) . "');\n";
        $content .= "define('SENDGRID_FROM_EMAIL', '" . addslashes($fromEmail) . "');\n";

        if (file_put_contents($configPath, $content)) {
            echo '<div style="font-family:Arial;padding:40px;background:#f5f5f5;">';
            echo '<h2 style="color:green;">✓ Config saved!</h2>';
            echo '<p>Key length: <strong>' . strlen($apiKey) . '</strong> characters</p>';
            echo '<p>Key preview: ' . htmlspecialchars(substr($apiKey, 0, 15)) . '...' . htmlspecialchars(substr($apiKey, -5)) . '</p>';
            echo '<p>From: ' . htmlspecialchars($fromEmail) . '</p>';
            echo '<p><a href="/check-mail">→ Verify config</a></p>';
            echo '</div>';
            exit;
        } else {
            echo '<h2 style="color:red;">Failed to write file - check permissions</h2>';
            exit;
        }
    }
}

// Show form
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Setup Mail</title></head>
<body style="font-family:Arial;padding:40px;background:#f5f5f5;">
<h2>Setup Mail Config</h2>
<form method="POST" action="">
    <p>
        <label><strong>SendGrid API Key (full, starts with SG.):</strong></label><br>
        <textarea name="key" required style="width:100%;padding:10px;min-height:60px;font-family:monospace;" placeholder="SG.xxxxx..."></textarea>
    </p>
    <p>
        <label><strong>From Email:</strong></label><br>
        <input name="from" type="email" value="winlink7@gmail.com" style="width:100%;padding:10px;" required/>
    </p>
    <p>
        <button type="submit" style="padding:12px 30px;background:#f2d00d;border:none;border-radius:6px;font-weight:bold;cursor:pointer;font-size:16px;">Save</button>
    </p>
</form>
</body>
</html>
