<?php
// Procesar registro de usuario

// Obtener datos del formulario
$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$contrasenna = $_POST['contrasenna'] ?? '';
$confirmar_contrasenna = $_POST['confirmar_contrasenna'] ?? '';

// Validación básica
if (empty($nombre) || empty($email) || empty($contrasenna)) {
    // Si hay campos vacíos, redirigir de vuelta al registro
    header("Location: registro.php?error=campos_vacios");
    exit;
}

// Validar que las contraseñas coincidan
if ($contrasenna !== $confirmar_contrasenna) {
    header("Location: registro.php?error=contrasenas_no_coinciden");
    exit;
}

// Hashear la contraseña antes de registrar
$hashed = password_hash($contrasenna, PASSWORD_DEFAULT);

require_once __DIR__ . '/../../Models/Model.php';

$result = RegistrarUsuario($nombre, $email, $hashed);

if ($result === true) {
    // Registro exitoso: iniciar sesión y redirigir
    if (session_status() == PHP_SESSION_NONE) session_start();
    $_SESSION['usuario_logueado'] = true;
    $_SESSION['usuario_nombre'] = $nombre;
    $_SESSION['usuario_email'] = $email;
    header("Location: ../Home/home.php");
    exit;
} else {
    // RegistrarUsuario devuelve mensaje de error en caso de fallo
    header("Location: registro.php?error=" . urlencode($result));
    exit;
}
?>
