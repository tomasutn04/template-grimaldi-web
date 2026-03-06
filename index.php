<?php
/**
 * ============================================================
 *  Grimaldi Agencies Argentina — Front Controller
 * ============================================================
 *  Main router for the application pages.
 * ============================================================
 */
require_once __DIR__ . '/src/config/config.php';

$requestBase = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Attempt to strip the subdirectory path if the app is hosted in a subfolder
$dirName = dirname($_SERVER['SCRIPT_NAME']);
if ($dirName !== '/' && $dirName !== '\\' && strpos($requestBase, $dirName) === 0) {
    $request = substr($requestBase, strlen($dirName));
} else {
    $request = $requestBase;
}

$request = trim($request, '/');

// Route /api/ requests to src/logic/api/
if (strpos($request, 'api/') === 0) {
    $apiRoute = substr($request, 4);
    $apiPath = __DIR__ . '/src/logic/api/' . $apiRoute;
    if (file_exists($apiPath) && is_file($apiPath)) {
        require $apiPath;
    } else if (file_exists($apiPath . '.php') && is_file($apiPath . '.php')) {
        require $apiPath . '.php';
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'API endpoint not found']);
    }
    exit;
}

// Basic Router
if ($request === '' || $request === 'index.html' || $request === 'index.php') {
    $page = 'index.php'; // HTML pages have been converted to PHP
} else {
    $page = $request;
}

$pagePath = __DIR__ . '/src/pages/' . $page;

if (file_exists($pagePath) && is_file($pagePath)) {
    require $pagePath;
} elseif (file_exists($pagePath . '.html') && is_file($pagePath . '.html')) {
    require $pagePath . '.html';
} elseif (file_exists($pagePath . '.php') && is_file($pagePath . '.php')) {
    require $pagePath . '.php';
} else {
    http_response_code(404);
    if (file_exists(__DIR__ . '/404.php')) {
        require __DIR__ . '/404.php';
    } else {
        echo "<h1>404 Not Found</h1>";
    }
}
