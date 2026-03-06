<?php
/**
 * Grimaldi Core Configuration
 * Defines essential constants for absolute routing and application configuration.
 */

// Autodetect the base protocol and host (for BASE_URL)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'] ?? 'localhost';
$path = dirname($_SERVER['SCRIPT_NAME'] ?? '');
if ($path === '\\' || $path === '/') {
    $path = '';
}

// Ensure the BASE_URL ends with a slash for consistent concatenation
define('BASE_URL', rtrim($protocol . $domainName . $path, '/') . '/');

// Root directory of the application
define('ROOT_DIR', dirname(__DIR__, 2) . DIRECTORY_SEPARATOR);

// Derived URL constants
define('ASSETS_URL', BASE_URL . 'public/assets');
define('CSS_URL', BASE_URL . 'public/assets/css');
define('JS_URL', BASE_URL . 'public/assets/js');

// Configuration loaded successfully

?>
