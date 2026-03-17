<?php
// Comprueba sesión y redirige al login si no hay sesión activa.
// Este archivo está pensado para ser auto-prepended por .htaccess (auto_prepend_file).

if (php_sapi_name() === 'cli') return; // no ejecutar en CLI

if (session_status() == PHP_SESSION_NONE) session_start();

$uri = $_SERVER['REQUEST_URI'] ?? '';
$uri = parse_url($uri, PHP_URL_PATH);

// Extensiones y rutas públicas permitidas (assets, login, registro, procesadores, logout)
$publicPrefixes = [
    '/G4_AmbienteWeb/Views/Home/inicio.php',
    '/G4_AmbienteWeb/Views/Home/registro.php',
    '/G4_AmbienteWeb/Views/Home/procesar_login.php',
    '/G4_AmbienteWeb/Views/Home/procesar_registro.php',
    '/G4_AmbienteWeb/Views/Home/logout.php',
    '/G4_AmbienteWeb/index.php',
    '/G4_AmbienteWeb/Database.sql',
];

$publicContains = [
    '/assets/',
    '/Views/assets/',
    '/assets/jss/',
    '/assets/css/',
    '/assets/fonts/',
    '/assets/images/',
    '/favicon.ico',
];

$allowedExt = ['css','js','png','jpg','jpeg','gif','svg','ico','woff','woff2','ttf','map'];

// Si la URI coincide con un prefijo público, permitir
foreach ($publicPrefixes as $p) {
    if (strpos($uri, $p) === 0) return;
}
// Si la URI contiene rutas públicas, permitir
foreach ($publicContains as $c) {
    if (strpos($uri, $c) !== false) return;
}
// Permitir archivos estáticos por extensión
$ext = pathinfo($uri, PATHINFO_EXTENSION);
if ($ext && in_array(strtolower($ext), $allowedExt, true)) return;

// Si el usuario está logueado, permitir
if (!empty($_SESSION['usuario_logueado'])) return;

// Evitar bucle si ya estamos en la página de inicio de sesión
if (strpos($uri, '/G4_AmbienteWeb/Views/Home/inicio.php') !== false) return;

// Redirigir al login indicando que se requiere autenticación
header('Location: /G4_AmbienteWeb/Views/Home/inicio.php?error=must_login');
exit;
