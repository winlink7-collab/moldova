<?php
/**
 * Email configuration - SendGrid
 * DO NOT COMMIT API KEY - set via config/mail.local.php
 */
if (file_exists(__DIR__ . '/mail.local.php')) {
    require_once __DIR__ . '/mail.local.php';
}
