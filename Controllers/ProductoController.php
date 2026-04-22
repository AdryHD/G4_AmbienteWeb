<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Controllers/UtilitarioController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Models/ProductoModel.php";

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

function ConsultarProducto($idProducto)
{
    return ConsultarProductoModel($idProducto);
}

if (isset($_POST["btnAgregarProducto"])) {

    $idCategoria = (int) $_POST["id_categoria"];
    $nombre      = trim($_POST["nombre"]);
    $descripcion = trim($_POST["descripcion"]);
    $precio      = (float) $_POST["precio"];
    $stock       = (int) $_POST["stock"];
    $talla       = trim($_POST["talla"]);
    $color       = trim($_POST["color"]);

    $imagen = '';
    if (!empty($_FILES["ImagenProducto"]["name"]) && $_FILES["ImagenProducto"]["error"] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES["ImagenProducto"]["name"]);
        $imagen        = '/G4_AmbienteWeb/Views/assets/images/products/' . $nombreArchivo;
        $destino       = $_SERVER["DOCUMENT_ROOT"] . $imagen;
        if (!copy($_FILES["ImagenProducto"]["tmp_name"], $destino)) {
            $_POST["Mensaje"]     = "Error al guardar la imagen. Verifique permisos de la carpeta.";
            $_POST["TipoMensaje"] = "danger";
            return;
        }
    }

    $result = AgregarProductoModel($idCategoria, $nombre, $descripcion, $precio, $stock, $talla, $color, $imagen);

    if ($result) {
        header("Location: /G4_AmbienteWeb/Views/Producto/consultarProductos.php?msg=agregado");
        exit;
    } else {
        $_POST["Mensaje"]     = "Error al agregar el producto. Intente de nuevo.";
        $_POST["TipoMensaje"] = "danger";
    }
}

if (isset($_POST["btnCambiarEstado"])) {
    $id     = (int)$_POST["id_producto"];
    $result = CambiarEstadoProductoModel($id);
    $_POST["Mensaje"]     = $result ? "Estado del producto actualizado." : "Error al actualizar el estado.";
    $_POST["TipoMensaje"] = $result ? "success" : "danger";
}

if (isset($_POST["btnToggleOferta"])) {
    $id     = (int)$_POST["id_producto"];
    $result = ToggleOfertaModel($id);
    $_POST["Mensaje"]     = $result ? "Estado de oferta actualizado." : "Error al actualizar la oferta.";
    $_POST["TipoMensaje"] = $result ? "success" : "danger";
}

if (isset($_POST["btnActualizarProducto"])) {

    $idProducto  = (int) $_POST["id_producto"];
    $idCategoria = (int) $_POST["id_categoria"];
    $nombre      = trim($_POST["nombre"]);
    $descripcion = trim($_POST["descripcion"]);
    $precio      = (float) $_POST["precio"];
    $stock       = (int) $_POST["stock"];
    $talla       = trim($_POST["talla"]);
    $color       = trim($_POST["color"]);

    $imagen = "";
    if (!empty($_FILES["ImagenProducto"]["name"]) && $_FILES["ImagenProducto"]["error"] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES["ImagenProducto"]["name"]);
        $imagen        = '/G4_AmbienteWeb/Views/assets/images/products/' . $nombreArchivo;
        $destino       = $_SERVER["DOCUMENT_ROOT"] . $imagen;
        if (!copy($_FILES["ImagenProducto"]["tmp_name"], $destino)) {
            $_POST["Mensaje"]     = "Error al guardar la imagen. Verifique permisos de la carpeta.";
            $_POST["TipoMensaje"] = "danger";
            return;
        }
    }

    $result = ActualizarProductoModel($idProducto, $idCategoria, $nombre, $descripcion, $precio, $stock, $talla, $color, $imagen);

    if ($result) {
        header("Location: /G4_AmbienteWeb/Views/Producto/consultarProductos.php?msg=actualizado");
        exit;
    } else {
        $_POST["Mensaje"]     = "Error al actualizar el producto. Intente de nuevo.";
        $_POST["TipoMensaje"] = "danger";
    }
}
