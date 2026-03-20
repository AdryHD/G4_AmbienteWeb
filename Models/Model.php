<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AMBIENTEWEB/Models/UtilitarioModel.php";

function RegistrarUsuario($Nombre, $Correo, $Contrasena)
{
    $context = OpenDatabase();

    try {
        $sp = "CALL sp_Registrar('$Nombre', '$Correo', '$Contrasena')";
        $result = $context->query($sp);

        CloseDatabase($context);
        return true;

    } catch (mysqli_sql_exception $e) {
        CloseDatabase($context);

        // Detecta si es error de duplicado
        if (strpos($e->getMessage(), "Duplicate entry") !== false) {
            return "El correo '$Correo' ya está registrado.";
        } else {
            return "Error al registrar usuario: " . $e->getMessage();
        }
    }
}

/**
 * LoginUsuario: llama a sp_Login y devuelve un arreglo asociativo con los datos
 * Devuelve: array con keys (id_usuario,nombre,correo,contrasena,id_rol) si existe,
 *           null si no existe,
 *           false en caso de error.
 */
function LoginUsuario($Correo)
{
    $context = OpenDatabase();
    try {
        $stmt = $context->prepare("CALL sp_Login(?)");
        $stmt->bind_param('s', $Correo);
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
