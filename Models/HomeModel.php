<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/UtilitarioModel.php";

function RegistrarModel($identificacion, $nombre, $contrasenna, $correoElectronico)
{
    try
    {
        $context = OpenDatabase();

        $hash = password_hash($contrasenna, PASSWORD_DEFAULT);
        $sp = "CALL sp_Registrar('$nombre', '$correoElectronico', '$hash', '$identificacion')";
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

        if (!$datos || empty($datos["contrasena"])) return null;

        $stored = (string)$datos["contrasena"];

        // Caso normal: hash seguro
        if (password_verify($contrasenna, $stored)) {
            if (password_needs_rehash($stored, PASSWORD_DEFAULT)) {
                $newHash = password_hash($contrasenna, PASSWORD_DEFAULT);
                include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/SeguridadModel.php";
                ActualizarContrasenaModel($newHash, (int)$datos["id_usuario"]);
            }
            return $datos;
        }

        // Migración automática: si estaba en texto plano, validar y convertir a hash
        if (hash_equals($stored, (string)$contrasenna)) {
            $newHash = password_hash($contrasenna, PASSWORD_DEFAULT);
            include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/SeguridadModel.php";
            ActualizarContrasenaModel($newHash, (int)$datos["id_usuario"]);
            $datos["contrasena"] = $newHash;
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
