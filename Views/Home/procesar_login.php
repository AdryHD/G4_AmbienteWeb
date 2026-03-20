<?php
// Procesar inicio de sesión contra la base de datos

// Obtener datos del formulario
$email = trim($_POST['email'] ?? '');
$contrasenna = $_POST['contrasenna'] ?? '';

// Validación básica
if (empty($email) || empty($contrasenna)) {
    header("Location: inicio.php?error=campos_vacios");
    exit;
}

require_once __DIR__ . '/../../Models/Model.php';

$user = LoginUsuario($email);
if ($user === false) {
    header("Location: /G4_AmbienteWeb/Views/Home/inicio.php?error=error_servidor");
    exit;
}

if ($user === null) {
    header("Location: /G4_AmbienteWeb/Views/Home/inicio.php?error=no_encontrado");
    exit;
}

$stored = $user['contrasena'];
$password_ok = false;
if (strpos($stored, '$2y$') === 0 || strpos($stored, '$2a$') === 0 || stripos($stored, 'argon2') !== false) {
    if (password_verify($contrasenna, $stored)) $password_ok = true;
} else {
    if ($contrasenna === $stored) $password_ok = true;
}

if ($password_ok) {
    if (session_status() == PHP_SESSION_NONE) session_start();
    $_SESSION['usuario_logueado'] = true;
    $_SESSION['usuario_id'] = $user['id_usuario'];
    $_SESSION['usuario_nombre'] = $user['nombre'];
    $_SESSION['usuario_email'] = $user['correo'];

    header("Location: /G4_AmbienteWeb/Views/Home/home.php");
    exit;
} else {
    header("Location: /G4_AmbienteWeb/Views/Home/inicio.php?error=credenciales_invalidas");
    exit;
}
?>
