<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Models/UtilitarioModel.php";

function RegistrarModel($identificacion, $nombre, $contrasenna, $correoElectronico)
{
    try
    {
        $context = OpenDatabase();
        
        // Hash de la contraseña con bcrypt
        $contrasennaHasheada = password_hash($contrasenna, PASSWORD_BCRYPT, ['cost' => 12]);
        
        // Escapar la contraseña para SQL seguro
        $contrasennaHasheada = $context->real_escape_string($contrasennaHasheada);

        $sp = "CALL sp_Registrar('$nombre', '$correoElectronico', '$contrasennaHasheada', '$identificacion')";
        $result = $context->query($sp);

        CloseDatabase($context);
        return $result;
    }
    catch (Exception $e)
    {
        return false;
    }
}

function IniciarSesionModel($correoElectronico, $contrasenna)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_Login('$correoElectronico')";
        $result = $context->query($sp);

        $datos = null;
        while ($fila = $result->fetch_assoc())
        {
            $datos = $fila;
        }

        CloseDatabase($context);

        // Verificar contraseña con password_verify usando bcrypt
        if ($datos && password_verify($contrasenna, $datos["contrasena"])) {
            return $datos;
        }
        return null;
    }
    catch (Exception $e)
    {
        return null;
    }
}

function ValidarCorreoModel($correo)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_ValidarCorreo('$correo')";
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
