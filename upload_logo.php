<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/models/Database.php';

$db = Database::getInstance();

// Handle POST - save logo URL
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $logoUrl = trim($_POST['logo_url'] ?? '');
    $hideText = isset($_POST['hide_text']) ? '1' : '0';

    // Save to settings
    $existing = $db->fetchOne("SELECT id FROM settings WHERE setting_key = ?", ['site_logo_image']);
    if ($existing) {
        $db->execute("UPDATE settings SET setting_value = ? WHERE setting_key = ?", [$logoUrl, 'site_logo_image']);
    } else {
        $db->insert('settings', ['setting_key' => 'site_logo_image', 'setting_value' => $logoUrl]);
    }

    $existingHide = $db->fetchOne("SELECT id FROM settings WHERE setting_key = ?", ['site_logo_hide_text']);
    if ($existingHide) {
        $db->execute("UPDATE settings SET setting_value = ? WHERE setting_key = ?", [$hideText, 'site_logo_hide_text']);
    } else {
        $db->insert('settings', ['setting_key' => 'site_logo_hide_text', 'setting_value' => $hideText]);
    }

    echo '<div style="font-family:Arial;padding:40px;background:#f0f0f0;">';
    echo '<h2 style="color:green;">✓ Logo saved!</h2>';
    echo '<p>Logo URL: ' . htmlspecialchars($logoUrl) . '</p>';
    echo '<p>Hide text: ' . ($hideText === '1' ? 'Yes' : 'No') . '</p>';
    if ($logoUrl) echo '<p><img src="' . htmlspecialchars($logoUrl) . '" style="max-width:200px;max-height:200px;border:1px solid #ddd;padding:10px;background:#fff;"/></p>';
    echo '<p><a href="/">Go to site</a> | <a href="/upload-logo">Change again</a></p>';
    echo '</div>';
    exit;
}

// Get current
$current = $db->fetchOne("SELECT setting_value FROM settings WHERE setting_key = ?", ['site_logo_image']);
$currentUrl = $current['setting_value'] ?? '';
$currentHide = $db->fetchOne("SELECT setting_value FROM settings WHERE setting_key = ?", ['site_logo_hide_text']);
$hideText = ($currentHide['setting_value'] ?? '0') === '1';
?>
<!DOCTYPE html>
<html dir="rtl">
<head><meta charset="utf-8"><title>Upload Logo</title></head>
<body style="font-family:Arial;padding:40px;background:#f5f5f5;">
<h2>🎨 העלאת לוגו האתר</h2>

<?php if ($currentUrl): ?>
<p><strong>לוגו נוכחי:</strong></p>
<img src="<?= htmlspecialchars($currentUrl) ?>" style="max-width:200px;max-height:200px;border:1px solid #ddd;padding:10px;background:#fff;"/>
<?php endif; ?>

<h3>אפשרות 1: הכנס URL של התמונה</h3>
<form method="POST">
    <p>
        <label><strong>URL של תמונת הלוגו:</strong></label><br>
        <input name="logo_url" type="url" value="<?= htmlspecialchars($currentUrl) ?>" style="width:100%;padding:10px;font-family:monospace;" placeholder="https://..."/>
    </p>
    <p>
        <label>
            <input type="checkbox" name="hide_text" <?= $hideText ? 'checked' : '' ?>/>
            <strong>הסתר טקסט "Royal Date" (הצג רק את הלוגו)</strong>
        </label>
    </p>
    <p>
        <button type="submit" style="padding:12px 30px;background:#f2d00d;border:none;border-radius:6px;font-weight:bold;cursor:pointer;font-size:16px;">שמור לוגו</button>
    </p>
</form>

<hr style="margin:30px 0;">

<h3>אפשרות 2: העלה קובץ</h3>
<form id="uploadForm" enctype="multipart/form-data">
    <p><input type="file" id="logoFile" accept="image/*"/></p>
    <p><button type="button" onclick="uploadLogo()" style="padding:12px 30px;background:#25D366;color:#fff;border:none;border-radius:6px;font-weight:bold;cursor:pointer;font-size:16px;">העלה לשרת</button></p>
</form>
<div id="uploadStatus"></div>

<script>
async function uploadLogo() {
    const file = document.getElementById('logoFile').files[0];
    if (!file) return alert('בחר קובץ');
    const fd = new FormData();
    fd.append('file', file);
    const status = document.getElementById('uploadStatus');
    status.innerHTML = '⏳ מעלה...';
    try {
        const res = await fetch('/api/upload', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.url) {
            status.innerHTML = '✓ הועלה! URL: <code>' + data.url + '</code><br>כעת העתק את ה-URL הזה ושים בשדה למעלה ולחץ שמור.';
            // Auto-fill
            document.querySelector('input[name="logo_url"]').value = data.url;
        } else {
            status.innerHTML = '❌ שגיאה: ' + (data.error || 'unknown');
        }
    } catch(e) {
        status.innerHTML = '❌ שגיאת רשת';
    }
}
</script>
</body>
</html>
