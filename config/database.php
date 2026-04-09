<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'adhbxejeen');
define('DB_PASS', '8gUM3nUeK6');
define('DB_NAME', 'adhbxejeen');
define('DB_CHARSET', 'utf8mb4');

define('UPLOAD_DIR', BASE_PATH . '/uploads');
define('UPLOAD_URL', BASE_URL . '/uploads');

if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}
