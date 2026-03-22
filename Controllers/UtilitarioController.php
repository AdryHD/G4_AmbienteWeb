<?php
// UtilitarioController.php — Esqueleto base estilo MN_ECC

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btnGenerarContrasenna'])) {
        // TODO: lógica para generar contraseña aleatoria
    }
    if (isset($_POST['btnEnviarCorreo'])) {
        // TODO: lógica para enviar correo (PHPMailer)
    }
}
// Si no es POST, redirigir a inicio
header('Location: ../Views/Home/inicio.php');
exit;
