<?php
// SeguridadController.php — Esqueleto base estilo MN_ECC

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btnCambiarAcceso'])) {
        // TODO: lógica para cambiar contraseña
    }
    if (isset($_POST['btnCambiarPerfil'])) {
        // TODO: lógica para cambiar perfil
    }
}
// Si no es POST, redirigir a inicio
header('Location: ../Views/Home/inicio.php');
exit;
