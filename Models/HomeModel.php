<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/UtilitarioModel.php";

function RegistrarModel($identificacion, $nombre, $contrasenna, $correoElectronico)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_Registrar('$nombre', '$correoElectronico', '$contrasenna', '$identificacion')";
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

        if ($datos && $datos["contrasena"] === $contrasenna) {
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
