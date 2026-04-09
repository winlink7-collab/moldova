<?php
// Delete the default Cloudways index.html
$file = __DIR__ . '/index.html';
if (file_exists($file)) {
    unlink($file);
    echo "index.html deleted successfully!";
} else {
    echo "index.html not found (already deleted or doesn't exist)";
}
echo "<br><br><a href='/'>Go to homepage</a>";
