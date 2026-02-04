<?php
// Procesar inicio de sesión

// Obtener datos del formulario
$email = $_POST['email'] ?? '';
$contrasenna = $_POST['contrasenna'] ?? '';

// Validación básica
if (empty($email) || empty($contrasenna)) {
    // Si hay campos vacíos, redirigir de vuelta al login
    header("Location: inicio.php?error=campos_vacios");
    exit;
}

// TODO: Aquí se debería validar el usuario contra la base de datos
// Por ahora, aceptamos cualquier login

// Crear sesión para el usuario
session_start();
$_SESSION['usuario_email'] = $email;
$_SESSION['usuario_nombre'] = explode('@', $email)[0]; // Usar la parte antes del @ como nombre
$_SESSION['usuario_logueado'] = true;

// Redirigir al home
header("Location: home.php");
exit;
?>
