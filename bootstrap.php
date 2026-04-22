<?php
/**
 * Bootstrap de rutas: hace el proyecto portable aunque la carpeta padre cambie.
 * Define:
 * - APP_FS_ROOT: ruta filesystem a /G4_AmbienteWeb
 * - APP_BASE_URL: ruta web base hasta /G4_AmbienteWeb (incluye carpeta padre si existe)
 */

if (!defined('APP_FS_ROOT')) {
    define('APP_FS_ROOT', realpath(__DIR__));
}

if (!defined('APP_BASE_URL')) {
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $marker = '/G4_AmbienteWeb/';
    $pos = strpos($script, $marker);
    if ($pos !== false) {
        $base = substr($script, 0, $pos + strlen('/G4_AmbienteWeb'));
        define('APP_BASE_URL', $base);
    } else {
        // fallback (estructura esperada)
        define('APP_BASE_URL', '/G4_AmbienteWeb');
    }
}

