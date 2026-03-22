<?php
// HomeController.php — Sintaxis y estructura tipo MN_ECC
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/HomeModel.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btnRegistrar'])) {
        // Registro de usuario
        $nombre = trim($_POST['nombre'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $contrasena = $_POST['contrasena'] ?? '';
        // TODO: agregar campo identificacion cuando se implemente
        $contrasenaHash = password_hash($contrasena, PASSWORD_BCRYPT);
        $result = RegistrarModel($nombre, $correo, $contrasenaHash);
        if ($result === true) {
            $_SESSION['mensaje'] = 'Usuario registrado correctamente.';
            $_SESSION['tipo_mensaje'] = 'success';
            header('Location: ../Views/Home/inicio.php');
            exit;
        } else {
            $_SESSION['mensaje'] = $result;
            $_SESSION['tipo_mensaje'] = 'danger';
            header('Location: ../Views/Home/registro.php');
            exit;
        }
    }
    if (isset($_POST['btnIniciarSesion'])) {
        // Inicio de sesión
        $correo = trim($_POST['email'] ?? '');
        $contrasena = $_POST['contrasena'] ?? '';
        $user = IniciarSesionModel($correo);
        if ($user === false) {
            $_SESSION['mensaje'] = 'Error del servidor. Inténtalo más tarde.';
            $_SESSION['tipo_mensaje'] = 'danger';
            header('Location: ../Views/Home/inicio.php');
            exit;
        }
        if ($user === null) {
            $_SESSION['mensaje'] = 'Usuario no encontrado.';
            $_SESSION['tipo_mensaje'] = 'warning';
            header('Location: ../Views/Home/inicio.php');
            exit;
        }
        $stored = $user['contrasena'];
        $password_ok = false;
        if (strpos($stored, '$2y$') === 0 || strpos($stored, '$2a$') === 0 || stripos($stored, 'argon2') !== false) {
            if (password_verify($contrasena, $stored)) $password_ok = true;
        } else {
            if ($contrasena === $stored) $password_ok = true;
        }
        if ($password_ok) {
            $_SESSION['usuario_logueado'] = true;
            $_SESSION['usuario_id'] = $user['id_usuario'];
            $_SESSION['usuario_nombre'] = $user['nombre'];
            $_SESSION['usuario_email'] = $user['correo'];
            header('Location: ../Views/Home/home.php');
            exit;
        } else {
            $_SESSION['mensaje'] = 'Correo o contraseña incorrectos.';
            $_SESSION['tipo_mensaje'] = 'danger';
            header('Location: ../Views/Home/inicio.php');
            exit;
        }
    }
    if (isset($_POST['btnCerrarSesion'])) {
        // Cerrar sesión
        session_unset();
        session_destroy();
        header('Location: ../Views/Home/inicio.php');
        exit;
    }
}
// Si no es POST, redirigir a inicio
header('Location: ../Views/Home/inicio.php');
exit;
