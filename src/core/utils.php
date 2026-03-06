<?php
/**
 * ============================================================
 *  Grimaldi Agencies Argentina — Core Utils
 * ============================================================
 *  Funciones centrales compartidas para la API Privada y Bridge
 *  - Carga de variables de entorno (loadEnv)
 *  - Respuestas JSON unificadas (jsonResponse)
 * ============================================================
 */

/**
 * Carga de .env (standalone, sin dependencias externas)
 * Parsea el archivo .env e ignora comentarios.
 */
function loadEnv(string $path): array {
    $vars = [];
    if (!file_exists($path)) {
        return $vars;
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        // Ignorar comentarios
        if (strpos($line, '#') === 0 || strpos($line, ';') === 0) continue;
        if (strpos($line, '=') === false) continue;
        [$key, $value] = explode('=', $line, 2);
        // Limpiar comillas iniciales/finales si existen
        $vars[trim($key)] = trim($value, " \t\n\r\0\x0B\"'");
    }
    return $vars;
}

/**
 * Función centralizada para enviar respuestas JSON estructuradas
 * Finaliza la ejecución del script después de emitir la respuesta.
 */
function jsonResponse(int $code, $data, ?string $error = null): void {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    
    $response = [
        'status' => ($code >= 200 && $code < 300) ? 'ok' : 'error',
        'timestamp' => date('c')
    ];
    
    if ($error !== null) {
        $response['error'] = $error;
    } else {
        $response['data'] = $data;
    }
    
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}
