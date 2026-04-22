<?php
require_once __DIR__ . "/../bootstrap.php";
include_once APP_FS_ROOT . "/Models/UtilitarioModel.php";

function RegistrarModel($identificacion, $nombre, $contrasenna, $correoElectronico)
{
    try
    {
        $context = OpenDatabase();

        $hash = password_hash($contrasenna, PASSWORD_DEFAULT);
        $sp = "CALL sp_Registrar('$nombre', '$correoElectronico', '$hash', '$identificacion')";
        $result = $context->query($sp);

        CloseDatabase($context);
        return ["success" => (bool)$result];
    }
    catch (Throwable $e)
    {
        $msg = $e->getMessage();

        if (stripos($msg, 'Falta el archivo `db_config.php`') !== false) {
            return [
                "success" => false,
                "error" => $msg
            ];
        }

        if (stripos($msg, 'Access denied') !== false) {
            return [
                "success" => false,
                "error" => "MySQL rechazó el acceso (`Access denied`). En `db_config.php` pon **exactamente** el mismo `user/pass/host/port` que usas en MySQL Workbench (ConneXamp). Si el password está mal, verás este error aunque la BD exista."
            ];
        }

        if (stripos($msg, 'sp_Registrar') !== false) {
            return [
                "success" => false,
                "error" => "No existe el procedimiento `sp_Registrar`. Importa `Database.sql` para crear la BD y los procedimientos."
            ];
        }

        if (stripos($msg, 'Duplicate entry') !== false || stripos($msg, '1062') !== false) {
            return [
                "success" => false,
                "error" => "El correo ya está registrado. Usa otro correo o inicia sesión."
            ];
        }

        return [
            "success" => false,
            "error" => "No fue posible registrar el usuario. Verifica la BD e inténtalo de nuevo."
        ];
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

        if (password_verify($contrasenna, $stored)) {
            if (password_needs_rehash($stored, PASSWORD_DEFAULT)) {
                $newHash = password_hash($contrasenna, PASSWORD_DEFAULT);
                include_once APP_FS_ROOT . "/Models/SeguridadModel.php";
                ActualizarContrasenaModel($newHash, (int)$datos["id_usuario"]);
            }
            return $datos;
        }

        // Migración automática desde texto plano
        if (hash_equals($stored, (string)$contrasenna)) {
            $newHash = password_hash($contrasenna, PASSWORD_DEFAULT);
            include_once APP_FS_ROOT . "/Models/SeguridadModel.php";
            ActualizarContrasenaModel($newHash, (int)$datos["id_usuario"]);
            $datos["contrasena"] = $newHash;
            return $datos;
        }

        return null;
    }
    catch (Throwable $e)
    {
        $msg = $e->getMessage();

        if (stripos($msg, 'Falta el archivo `db_config.php`') !== false) {
            return [
                "success" => false,
                "error" => $msg
            ];
        }

        if (stripos($msg, 'Access denied') !== false) {
            return [
                "success" => false,
                "error" => "MySQL rechazó el acceso (`Access denied`). En `db_config.php` pon **exactamente** el mismo `user/pass/host/port` que usas en MySQL Workbench (ConneXamp). Si el password está mal, verás este error aunque la BD exista."
            ];
        }

        if (stripos($msg, 'sp_Login') !== false) {
            return [
                "success" => false,
                "error" => "No existe el procedimiento `sp_Login`. Importa `Database.sql` para crear la BD y los procedimientos."
            ];
        }

        return [
            "success" => false,
            "error" => "No fue posible iniciar sesión. Verifica la BD e inténtalo de nuevo."
        ];
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
