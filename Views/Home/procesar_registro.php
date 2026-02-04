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

// TODO: Aquí se debería guardar el usuario en la base de datos
// Por ahora, simplemente redirigimos al home

// Crear sesión para el usuario
session_start();
$_SESSION['usuario_nombre'] = $nombre;
$_SESSION['usuario_email'] = $email;
$_SESSION['usuario_logueado'] = true;

// Redirigir al home
header("Location: home.php");
exit;
?>
