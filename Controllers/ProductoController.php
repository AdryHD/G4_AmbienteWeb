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

function ConsultarCategorias()
{
    return ConsultarCategoriasModel();
}

if (isset($_POST["btnAgregarProducto"])) {

    $idCategoria = (int) $_POST["id_categoria"];
    $nombre      = trim($_POST["nombre"]);
    $descripcion = trim($_POST["descripcion"]);
    $precio      = (float) $_POST["precio"];
    $stock       = (int) $_POST["stock"];
    $talla       = trim($_POST["talla"]);
    $color       = trim($_POST["color"]);
    $imagen      = trim($_POST["imagen"]);

    $result = AgregarProductoModel($idCategoria, $nombre, $descripcion, $precio, $stock, $talla, $color, $imagen);

    if ($result) {
        $_POST["Mensaje"]     = "Producto agregado correctamente.";
        $_POST["TipoMensaje"] = "success";
    } else {
        $_POST["Mensaje"]     = "Error al agregar el producto. Intente de nuevo.";
        $_POST["TipoMensaje"] = "danger";
    }
}

if (isset($_POST["btnCambiarEstado"])) {
    // TODO: implementar cambio de estado de producto
}
