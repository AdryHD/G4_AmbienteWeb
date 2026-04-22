<?php
/**
 * Bootstrap de rutas (raíz del proyecto).
 * Define:
 * - APP_FS_ROOT: ruta filesystem del proyecto (raíz)
 * - APP_BASE_URL: ruta web base hasta la raíz del proyecto (incluye carpeta padre si existe)
 */

if (!defined('APP_FS_ROOT')) {
    define('APP_FS_ROOT', realpath(__DIR__));
}

if (!defined('APP_BASE_URL')) {
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $marker = '/Views/';
    $pos = strpos($script, $marker);
    if ($pos !== false) {
        $base = substr($script, 0, $pos);
        if ($base === '') $base = '/';
        define('APP_BASE_URL', rtrim($base, '/'));
    } else {
        define('APP_BASE_URL', '');
    }
}

