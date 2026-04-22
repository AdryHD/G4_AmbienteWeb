<?php
// Comprueba sesión, redirige al login si no hay sesión activa, y valida permisos por rol.
// Este archivo está pensado para ser auto-prepended por .htaccess (auto_prepend_file).

if (php_sapi_name() === 'cli') return; // no ejecutar en CLI

if (session_status() == PHP_SESSION_NONE) session_start();

$uri = $_SERVER['REQUEST_URI'] ?? '';
$uri = parse_url($uri, PHP_URL_PATH);

// Extensiones y rutas públicas permitidas (assets, login, registro, procesadores, logout)
$publicPrefixes = [
    '/G4_AmbienteWeb-main/Views/Home/inicio.php',
    '/G4_AmbienteWeb-main/Views/Home/registro.php',
    '/G4_AmbienteWeb-main/Views/Home/recuperarAcceso.php',
    '/G4_AmbienteWeb-main/index.php',
    '/G4_AmbienteWeb-main/Database.sql',
];

$publicContains = [
    '/assets/',
    '/Views/assets/',
    '/assets/jss/',
    '/assets/css/',
    '/assets/fonts/',
    '/assets/images/',
    '/favicon.ico',
    '/Controllers/',
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
if (!empty($_SESSION['usuario_logueado'])) {
    
    // VALIDACIÓN RBAC - Control de acceso basado en roles
    // ID de roles: 1 = administrador, 2 = cliente
    $idRolAdmin = 1;
    $idRolCliente = 2;
    
    $rolActual = $_SESSION['usuario_rol'] ?? null;
    
    // Rutas solo para ADMINISTRADOR
    $rutasAdmin = [
        '/G4_AmbienteWeb-main/Views/Admin/',
        '/G4_AmbienteWeb-main/Views/Producto/tienda.php',  // Admin NO puede ver tienda
    ];
    
    // Rutas solo para CLIENTE
    $rutasCliente = [
        '/G4_AmbienteWeb-main/Views/Producto/carrito.php',
        '/G4_AmbienteWeb-main/Views/Producto/consultarProductos.php',
    ];
    
    // Rutas restringidas para ADMIN (no puede acceder como admin)
    $rutasRestringidasAdmin = [
        '/G4_AmbienteWeb-main/Views/Producto/tienda.php',
        '/G4_AmbienteWeb-main/Views/Producto/carrito.php',
        '/G4_AmbienteWeb-main/Views/Producto/consultarProductos.php',
    ];
    
    // Rutas restringidas para CLIENTE (no puede acceder)
    $rutasRestringidasCliente = [
        '/G4_AmbienteWeb-main/Views/Admin/',
        '/G4_AmbienteWeb-main/Views/Producto/tienda.php',
        '/G4_AmbienteWeb-main/Views/Pedido/',
    ];
    
    // Validar si es Admin intentando acceder a rutas restringidas
    if ($rolActual == $idRolAdmin) {
        foreach ($rutasRestringidasAdmin as $ruta) {
            if (strpos($uri, $ruta) === 0) {
                http_response_code(403);
                $_SESSION['error_acceso'] = 'Los administradores no tienen acceso a esta sección.';
                header('Location: /G4_AmbienteWeb-main/Views/Home/home.php');
                exit;
            }
        }
    }
    
    // Validar si es Cliente intentando acceder a rutas restringidas
    if ($rolActual == $idRolCliente) {
        foreach ($rutasRestringidasCliente as $ruta) {
            if (strpos($uri, $ruta) === 0) {
                http_response_code(403);
                $_SESSION['error_acceso'] = 'Los clientes no tienen acceso a esta sección.';
                header('Location: /G4_AmbienteWeb-main/Views/Home/home.php');
                exit;
            }
        }
    }
    
    return;
}

// Evitar bucle si ya estamos en la página de inicio de sesión
if (strpos($uri, '/G4_AmbienteWeb-main/Views/Home/inicio.php') !== false) return;

// Redirigir al login indicando que se requiere autenticación
header('Location: /G4_AmbienteWeb-main/Views/Home/inicio.php?error=must_login');
exit;
