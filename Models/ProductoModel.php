<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/UtilitarioModel.php";

function ConsultarProductosModel()
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_ConsultarProductos()";
        $result = $context->query($sp);

        $datos = [];
        while ($fila = $result->fetch_assoc())
        {
            $datos[] = $fila;
        }

        CloseDatabase($context);
        return $datos;
    }
    catch (Exception $e)
    {
        return null;
    }
}

function ConsultarCategoriasModel()
{
    try
    {
        $context = OpenDatabase();
        $result  = $context->query("SELECT id_categoria, nombre FROM categorias WHERE estado = 'activo' ORDER BY nombre");
        $datos   = [];
        while ($fila = $result->fetch_assoc())
        {
            $datos[] = $fila;
        }
        CloseDatabase($context);
        return $datos;
    }
    catch (Exception $e)
    {
        return null;
    }
}

function CambiarEstadoProductoModel($idProducto)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_CambiarEstadoProducto('$idProducto')";
        $result = $context->query($sp);

        CloseDatabase($context);
        return $result;
    }
    catch (Exception $e)
    {
        return false;
    }
}

function ToggleOfertaModel($idProducto)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_ToggleOferta('$idProducto')";
        $result = $context->query($sp);

        CloseDatabase($context);
        return $result;
    }
    catch (Exception $e)
    {
        return false;
    }
}

function ConsultarProductoModel($idProducto)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_ConsultarProducto('$idProducto')";
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

function ActualizarProductoModel($idProducto, $idCategoria, $nombre, $descripcion, $precio, $stock, $talla, $color, $imagen)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_ActualizarProducto('$idProducto', '$idCategoria', '$nombre', '$descripcion', '$precio', '$stock', '$talla', '$color', '$imagen')";
        $result = $context->query($sp);

        CloseDatabase($context);
        return $result;
    }
    catch (Exception $e)
    {
        return false;
    }
}

function AgregarProductoModel($idCategoria, $nombre, $descripcion, $precio, $stock, $talla, $color, $imagen)
{
    try
    {
        $context = OpenDatabase();

        $sp = "CALL sp_AgregarProducto('$idCategoria', '$nombre', '$descripcion', '$precio', '$stock', '$talla', '$color', '$imagen')";
        $result = $context->query($sp);

        CloseDatabase($context);
        return $result;
    }
    catch (Exception $e)
    {
        return false;
    }
}
