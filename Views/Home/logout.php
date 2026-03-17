<?php
// Cerrar sesión y redirigir al inicio
if (session_status() == PHP_SESSION_NONE) session_start();

// Unset all session variables
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Redirigir al login con ruta absoluta dentro del proyecto
header("Location: /G4_AmbienteWeb/Views/Home/inicio.php");
exit;
?>