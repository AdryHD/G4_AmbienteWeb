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

    $hashNueva = password_hash($nuevaContrasena, PASSWORD_DEFAULT);
    $result = ActualizarContrasenaModel($hashNueva, $id_usuario);

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

if (isset($_POST["btnActualizarRol"])) {
    if (session_status() === PHP_SESSION_NONE) session_start();

    $miId = (int)($_SESSION["usuario_id"] ?? 0);
    $miRol = (int)($_SESSION["usuario_rol"] ?? 0);

    if ($miRol !== 1) {
        header("Location: /G4_AmbienteWeb/Views/Home/home.php?error=forbidden");
        exit;
    }

    $idUsuario = (int)($_POST["id_usuario"] ?? 0);
    $nuevoRol  = (int)($_POST["id_rol"] ?? 0);

    if ($idUsuario <= 0 || ($nuevoRol !== 1 && $nuevoRol !== 2)) {
        $_SESSION["mensaje"] = "Datos inválidos para actualizar el rol.";
        $_SESSION["tipo_mensaje"] = "danger";
        header("Location: /G4_AmbienteWeb/Views/Seguridad/gestionarUsuarios.php");
        exit;
    }

    if ($idUsuario === $miId) {
        $_SESSION["mensaje"] = "No puedes modificar tu propio rol.";
        $_SESSION["tipo_mensaje"] = "danger";
        header("Location: /G4_AmbienteWeb/Views/Seguridad/gestionarUsuarios.php");
        exit;
    }

    $ok = ActualizarRolUsuarioModel($idUsuario, $nuevoRol);
    $_SESSION["mensaje"] = $ok ? "Rol actualizado correctamente." : "No se pudo actualizar el rol.";
    $_SESSION["tipo_mensaje"] = $ok ? "success" : "danger";
    header("Location: /G4_AmbienteWeb/Views/Seguridad/gestionarUsuarios.php");
    exit;
}

function ListarUsuarios()
{
    return ListarUsuariosModel();
}
