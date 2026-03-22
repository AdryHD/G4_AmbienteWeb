<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/UtilitarioModel.php";

function RegistrarModel($nombre, $correo, $contrasena)
{
    $context = OpenDatabase();
    try {
        $stmt = $context->prepare("CALL sp_Registrar(?, ?, ?)");
        $stmt->bind_param('sss', $nombre, $correo, $contrasena);
        $stmt->execute();
        $stmt->close();
        CloseDatabase($context);
        return true;
    } catch (mysqli_sql_exception $e) {
        if (isset($stmt) && $stmt) $stmt->close();
        CloseDatabase($context);
        if (strpos($e->getMessage(), "Duplicate entry") !== false) {
            return "El correo '$correo' ya está registrado.";
        } else {
            return "Error al registrar usuario: " . $e->getMessage();
        }
    }
}

function IniciarSesionModel($correo)
{
    $context = OpenDatabase();
    try {
        $stmt = $context->prepare("CALL sp_Login(?)");
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $stmt->bind_result($id_usuario, $nombre, $correo, $contrasena, $id_rol);
        $fetched = $stmt->fetch();
        if ($fetched) {
            $user = [
                'id_usuario' => $id_usuario,
                'nombre' => $nombre,
                'correo' => $correo,
                'contrasena' => $contrasena,
                'id_rol' => $id_rol,
            ];
            $stmt->close();
            CloseDatabase($context);
            return $user;
        } else {
            $stmt->close();
            CloseDatabase($context);
            return null;
        }
    } catch (Exception $e) {
        if (isset($stmt) && $stmt) $stmt->close();
        if (isset($context)) CloseDatabase($context);
        return false;
    }
}
