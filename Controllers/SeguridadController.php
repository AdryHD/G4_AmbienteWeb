<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/UtilitarioController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/SeguridadModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["btnCambiarAcceso"])) {

    $nuevaContrasena  = $_POST["NuevaContrasena"];
    $id_usuario       = $_SESSION["usuario_id"];
    $correo           = $_SESSION["usuario_email"];
    $nombre           = $_SESSION["usuario_nombre"];

    $result = ActualizarContrasenaModel($nuevaContrasena, $id_usuario);

    if ($result) {
        session_unset();
        session_destroy();

        $plantilla    = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/emails/cambioAcceso.html");
        $cuerpoCorreo = str_replace(
            ["{{NOMBRE}}", "{{FECHA}}"],
            [$nombre, date("d/m/Y H:i")],
            $plantilla
        );

        EnviarCorreo("Cambio de Contraseña - PowerZone", $cuerpoCorreo, $correo);

        $_SESSION["mensaje"]      = "Contraseña actualizada correctamente. Inicia sesión con tu nueva contraseña.";
        $_SESSION["tipo_mensaje"] = "success";
        header("Location: /G4_AmbienteWeb/Views/Home/inicio.php");
        exit;
    } else {
        $_POST["Mensaje"] = "Su contraseña no pudo ser actualizada.";
    }
}

if (isset($_POST["btnCambiarPerfil"])) {

    $nombre     = $_POST["Nombre"];
    $correo     = $_POST["CorreoElectronico"];
    $cedula     = $_POST["Cedula"] ?? '';
    $id_usuario = $_SESSION["usuario_id"];

    $result = ActualizarPerfilModel($nombre, $correo, $cedula, $id_usuario);

    if ($result) {
        $_SESSION["usuario_nombre"] = $nombre;
        $_SESSION["usuario_email"]  = $correo;
        $_POST["Mensaje"]      = "Cambios realizados con éxito.";
        $_POST["TipoMensaje"]  = "success";
    } else {
        $_POST["Mensaje"]      = "Sus datos no pudieron ser actualizados.";
        $_POST["TipoMensaje"]  = "danger";
    }
}

function ConsultarUsuario()
{
    $id_usuario = $_SESSION["usuario_id"];
    return ConsultarUsuarioModel($id_usuario);
}
