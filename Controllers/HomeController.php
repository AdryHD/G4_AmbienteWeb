<?php
require_once __DIR__ . "/../bootstrap.php";
include_once APP_FS_ROOT . "/Controllers/UtilitarioController.php";
include_once APP_FS_ROOT . "/Models/HomeModel.php";
include_once APP_FS_ROOT . "/Models/SeguridadModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["btnRegistrar"])) {

    $identificacion    = $_POST["Identificacion"];
    $nombre            = $_POST["Nombre"];
    $correoElectronico = $_POST["CorreoElectronico"];
    $contrasenna       = $_POST["Contrasenna"];

    $result = RegistrarModel($identificacion, $nombre, $contrasenna, $correoElectronico);

    $ok = is_array($result) ? !empty($result["success"]) : (bool)$result;
    if ($ok) {
        $_SESSION["mensaje"]      = "Usuario registrado correctamente.";
        $_SESSION["tipo_mensaje"] = "success";
        header("Location: " . APP_BASE_URL . "/Views/Home/inicio.php");
        exit;
    } else {
        $err = is_array($result) ? ($result["error"] ?? null) : null;
        $_POST["Mensaje"]     = $err ?: "Su información no fue registrada correctamente.";
        $_POST["TipoMensaje"] = "danger";
    }
}

if (isset($_POST["btnIniciarSesion"])) {

    $correoElectronico = $_POST["CorreoElectronico"];
    $contrasenna       = $_POST["Contrasenna"];

    $result = IniciarSesionModel($correoElectronico, $contrasenna);

    $ok = false;
    if (is_array($result)) {
        if (array_key_exists("success", $result) && !$result["success"]) {
            $ok = false;
        } else {
            $ok = !empty($result["id_usuario"]);
        }
    }

    if ($ok) {
        $_SESSION["usuario_logueado"]    = true;
        $_SESSION["usuario_id"]          = $result["id_usuario"];
        $_SESSION["usuario_nombre"]      = $result["nombre"];
        $_SESSION["usuario_email"]       = $result["correo"];
        $_SESSION["usuario_rol"]         = $result["id_rol"];
        $_SESSION["usuario_nombre_rol"]  = $result["nombre_rol"];
        header("Location: " . APP_BASE_URL . "/Views/Home/home.php");
        exit;
    } else {
        $err = is_array($result) ? ($result["error"] ?? null) : null;
        $_POST["Mensaje"]     = $err ?: "Su información no fue autenticada correctamente.";
        $_POST["TipoMensaje"] = "danger";
    }
}

if (isset($_POST["btnRecuperarAcceso"])) {

    $correo = $_POST["CorreoElectronico"];

    $result = ValidarCorreoModel($correo);

    if ($result) {

        $nuevaContrasena = GenerarContrasena();
        $hashNueva       = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
        $actualizacion   = ActualizarContrasenaModel($hashNueva, $result["id_usuario"]);

        if ($actualizacion) {

            $plantilla    = file_get_contents(APP_FS_ROOT . "/Views/emails/recuperarAcceso.html");
            $cuerpoCorreo = str_replace(
                ["{{NOMBRE}}", "{{CONTRASENA}}"],
                [$result["nombre"], $nuevaContrasena],
                $plantilla
            );

            EnviarCorreo("Recuperar Acceso - PowerZone", $cuerpoCorreo, $result["correo"]);

            header("Location: " . APP_BASE_URL . "/Views/Home/inicio.php");
            exit;
        }
    }

    $_POST["Mensaje"] = "El correo ingresado no está registrado.";
}

if (isset($_POST["btnCerrarSesion"])) {
    session_unset();
    session_destroy();
    echo json_encode("OK");
}
// crear metodo para validar rol de administrador
function esAdministrador() {
    return isset($_SESSION["usuario_rol"]) && $_SESSION["usuario_rol"] === 1;
}