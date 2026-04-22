<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/UtilitarioController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/AdminModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar que el usuario es administrador
function ValidarAccesoAdmin()
{
    if (!isset($_SESSION['usuario_logueado']) || $_SESSION['usuario_logueado'] !== true) {
        header("Location: /G4_AmbienteWeb/Views/Home/inicio.php");
        exit;
    }
    
    // Verificar que el usuario tiene rol de administrador (id_rol = 1)
    if ($_SESSION['usuario_rol'] != 1) {
        http_response_code(403);
        $_SESSION["mensaje"]      = "No tienes permiso para acceder al panel administrativo.";
        $_SESSION["tipo_mensaje"] = "danger";
        header("Location: /G4_AmbienteWeb/Views/Home/home.php");
        exit;
    }
}

// Listar todos los usuarios
function ListarUsuarios()
{
    return ListarUsuariosModel();
}

// Cambiar el rol de un usuario
if (isset($_POST["btnCambiarRol"])) {
    
    $id_usuario_destino = $_POST["id_usuario"] ?? null;
    $nuevo_rol         = $_POST["nuevo_rol"] ?? null;
    $id_admin_actual    = $_SESSION["usuario_id"] ?? null;
    
    // Validar que el admin no intente cambiar su propio rol
    if ($id_usuario_destino == $id_admin_actual) {
        $_POST["Mensaje"]      = "No puedes cambiar tu propio rol.";
        $_POST["TipoMensaje"]  = "danger";
    } else if ($id_usuario_destino && $nuevo_rol) {
        // El nuevo_rol debe ser 1 (admin) o 2 (cliente)
        if ($nuevo_rol !== '1' && $nuevo_rol !== '2') {
            $_POST["Mensaje"]      = "Rol inválido.";
            $_POST["TipoMensaje"]  = "danger";
        } else {
            $result = CambiarRolUsuarioModel($id_usuario_destino, $nuevo_rol);
            
            if ($result) {
                $_POST["Mensaje"]      = "Rol de usuario actualizado correctamente.";
                $_POST["TipoMensaje"]  = "success";
            } else {
                $_POST["Mensaje"]      = "Error al cambiar el rol del usuario.";
                $_POST["TipoMensaje"]  = "danger";
            }
        }
    }
}

// Obtener info de un usuario específico
function ConsultarUsuarioAdmin($id_usuario)
{
    return ConsultarUsuarioAdminModel($id_usuario);
}
