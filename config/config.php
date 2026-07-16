<?php
// config/config.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define Base URL dynamically
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . ($scriptDir === '/' ? '' : $scriptDir) . '/';

define('BASE_URL', $baseUrl);
define('UPLOAD_PATH', __DIR__ . '/../uploads/materials/');

// Helper function untuk sanitasi XSS saat render HTML
function escape($html) {
    return htmlspecialchars($html ?? '', ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?>
