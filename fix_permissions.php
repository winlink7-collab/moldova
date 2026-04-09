<?php
header('Content-Type: text/html; charset=utf-8');
echo "<h2>Fixing permissions...</h2>";

$dirs = [
    __DIR__ . '/public/uploads',
    __DIR__ . '/public/uploads/profiles',
    __DIR__ . '/uploads',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0775, true)) {
            echo "Created: $dir<br>";
        } else {
            echo "FAILED to create: $dir<br>";
        }
    } else {
        echo "Exists: $dir<br>";
    }

    if (is_writable($dir)) {
        echo "  -> Writable: YES<br>";
    } else {
        echo "  -> Writable: NO - trying chmod...<br>";
        chmod($dir, 0775);
        echo "  -> After chmod: " . (is_writable($dir) ? "YES" : "STILL NO") . "<br>";
    }
}

// Test write
$testFile = __DIR__ . '/public/uploads/test_write.txt';
if (file_put_contents($testFile, 'test')) {
    echo "<br><b>Write test: SUCCESS</b><br>";
    unlink($testFile);
} else {
    echo "<br><b>Write test: FAILED</b><br>";
}

echo "<br>PHP upload_max_filesize: " . ini_get('upload_max_filesize');
echo "<br>PHP post_max_size: " . ini_get('post_max_size');
echo "<br>PHP max_file_uploads: " . ini_get('max_file_uploads');
