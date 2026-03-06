<?php
/**
 * ============================================================
 *  Grimaldi Agencies Argentina — Centralized Database Connection
 * ============================================================
 *  Single source of truth for PDO connections.
 *  Reads credentials from .env via loadEnv() (src/core/utils.php).
 *  Used by: Public API endpoints, Admin Portal, Bridge API.
 * ============================================================
 */

require_once __DIR__ . '/utils.php';

// Prevent multiple connections
if (isset($pdo) && $pdo instanceof PDO) {
    return;
}

// Load environment variables
$env = loadEnv(dirname(__DIR__, 2) . '/.env');

$DB_HOST    = $env['DB_HOST']    ?? 'localhost';
$DB_USER    = $env['DB_USER']    ?? '';
$DB_PASS    = $env['DB_PASS']    ?? '';
$DB_NAME    = $env['DB_NAME']    ?? 'l0013963_gri';
$DB_CHARSET = 'utf8mb4';

$dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset={$DB_CHARSET}";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (\PDOException $e) {
    // Log the real error securely, never expose to client
    $logDir = dirname(__DIR__, 2) . '/src/data/logs';
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    @error_log(
        '[' . date('Y-m-d H:i:s') . '] DB Connection Error: ' . $e->getMessage() . PHP_EOL,
        3,
        $logDir . '/app.log'
    );
    
    // Return a generic error — never expose DB details
    if (php_sapi_name() === 'cli') {
        die("Error de conexión a la base de datos.\n");
    }
    
    http_response_code(500);
    die("Error de conexión a la base de datos.");
}
