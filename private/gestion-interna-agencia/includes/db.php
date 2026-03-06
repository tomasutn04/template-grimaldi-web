<?php
/**
 * ============================================================
 *  Admin Portal — Database Connection (Proxy)
 * ============================================================
 *  Delegates to the centralized database connection in src/core/database.php.
 *  This file exists for backwards compatibility with admin portal includes.
 * ============================================================
 */
require_once dirname(__DIR__, 3) . '/src/core/database.php';
