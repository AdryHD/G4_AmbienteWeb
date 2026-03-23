<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/UtilitarioController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/ProductoModel.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function ConsultarProductos()
{
    return ConsultarProductosModel();
}

if (isset($_POST["btnCambiarEstado"])) {
    // TODO: implementar cambio de estado de producto
}
