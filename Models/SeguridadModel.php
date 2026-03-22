<?php
// SeguridadModel.php — Esqueleto base estilo MN_ECC
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/UtilitarioModel.php";

function ConsultarUsuarioModel($id_usuario)
{
    $context = OpenDatabase();
    // TODO: Implementar consulta real a la base de datos
    // Ejemplo: $stmt = $context->prepare("CALL sp_ConsultarUsuario(?)");
    // $stmt->bind_param('i', $id_usuario);
    // ...
    CloseDatabase($context);
    return null;
}
