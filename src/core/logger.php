<?php
/**
 * ============================================================
 *  Grimaldi Agencies Argentina — Application Logger
 * ============================================================
 *  File-based logging system for shared hosting.
 *  Writes to: src/data/logs/app.log
 *  Auto-creates the log directory if needed.
 * ============================================================
 */

define('LOG_DIR', dirname(__DIR__) . '/data/logs');

/**
 * Write a log entry to the application log file.
 *
 * @param string $level   Log level: INFO, WARNING, ERROR
 * @param string $message Human-readable message
 * @param array  $context Optional key-value context data  
 */
function appLog(string $level, string $message, array $context = []): void
{
    if (!is_dir(LOG_DIR)) {
        @mkdir(LOG_DIR, 0755, true);
    }

    $timestamp = date('Y-m-d H:i:s');
    $contextStr = !empty($context) ? ' | ' . json_encode($context, JSON_UNESCAPED_UNICODE) : '';
    $entry = "[{$timestamp}] [{$level}] {$message}{$contextStr}" . PHP_EOL;

    @file_put_contents(LOG_DIR . '/app.log', $entry, FILE_APPEND | LOCK_EX);
}

/**
 * Log an informational message.
 */
function logInfo(string $message, array $context = []): void
{
    appLog('INFO', $message, $context);
}

/**
 * Log a warning message.
 */
function logWarning(string $message, array $context = []): void
{
    appLog('WARNING', $message, $context);
}

/**
 * Log an error message.
 */
function logError(string $message, array $context = []): void
{
    appLog('ERROR', $message, $context);
}
