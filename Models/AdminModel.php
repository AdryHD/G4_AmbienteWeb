<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/UtilitarioModel.php";

/**
 * Listar todos los usuarios con sus roles
 * @return array|null Lista de usuarios o null si hay error
 */
function ListarUsuariosModel()
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_ListarUsuarios()";
        $result = $context->query($sp);

        $usuarios = array();
        while ($fila = $result->fetch_assoc())
        {
            $usuarios[] = $fila;
        }

        CloseDatabase($context);
        
        return count($usuarios) > 0 ? $usuarios : null;
    }
    catch (Exception $e)
    {
        return null;
    }
}

/**
 * Cambiar el rol de un usuario
 * @param int $id_usuario ID del usuario
 * @param int $nuevo_rol ID del nuevo rol (1=admin, 2=cliente)
 * @return bool true si se actualizó correctamente
 */
function CambiarRolUsuarioModel($id_usuario, $nuevo_rol)
{
    try
    {
        $context = OpenDatabase();

        // Validar que los parámetros sean válidos
        $id_usuario = intval($id_usuario);
        $nuevo_rol  = intval($nuevo_rol);
        
        if ($id_usuario <= 0 || ($nuevo_rol != 1 && $nuevo_rol != 2)) {
            return false;
        }

        $sp = "CALL sp_CambiarRolUsuario($id_usuario, $nuevo_rol)";
        $result = $context->query($sp);

        CloseDatabase($context);
        return $result;
    }
    catch (Exception $e)
    {
        return false;
    }
}

/**
 * Obtener información de un usuario específico
 * @param int $id_usuario ID del usuario
 * @return array|null Datos del usuario o null si no existe
 */
function ConsultarUsuarioAdminModel($id_usuario)
{
    try
    {
        $context = OpenDatabase();

        $id_usuario = intval($id_usuario);
        $sp = "CALL sp_ConsultarUsuario($id_usuario)";
        $result = $context->query($sp);

        $datos = null;
        while ($fila = $result->fetch_assoc())
        {
            $datos = $fila;
        }

        CloseDatabase($context);
        return $datos;
    }
    catch (Exception $e)
    {
        return null;
    }
}
