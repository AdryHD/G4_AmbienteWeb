<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/UtilitarioModel.php";

function ConsultarUsuarioModel($id_usuario)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_ConsultarUsuario('$id_usuario')";
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

function ActualizarPerfilModel($nombre, $correo, $cedula, $id_usuario)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_ActualizarPerfil('$nombre', '$correo', '$cedula', '$id_usuario')";

        $result = $context->query($sp);

        CloseDatabase($context);
        return $result;
    }
    catch (Exception $e)
    {
        return false;
    }
}

function ActualizarContrasenaModel($nuevaContrasena, $id_usuario)
{
    try
    {
        $context = OpenDatabase();

        // Hash de la nueva contraseña con bcrypt
        $contrasennaHasheada = password_hash($nuevaContrasena, PASSWORD_BCRYPT, ['cost' => 12]);
        $contrasennaHasheada = $context->real_escape_string($contrasennaHasheada);

        $sp = "CALL sp_ActualizarContrasena('$contrasennaHasheada', '$id_usuario')";
        $result = $context->query($sp);

        CloseDatabase($context);
        return $result;
    }
    catch (Exception $e)
    {
        return false;
    }
}
