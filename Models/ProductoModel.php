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

function AgregarProductoModel($idCategoria, $nombre, $descripcion, $precio, $stock, $talla, $color, $imagen)
{
    try
    {
        $context = OpenDatabase();

        $stmt = $context->prepare(
            "INSERT INTO productos (id_categoria, nombre, descripcion, precio, stock, talla, color, imagen, estado)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'activo')"
        );
        $stmt->bind_param("issdisss", $idCategoria, $nombre, $descripcion, $precio, $stock, $talla, $color, $imagen);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();

        CloseDatabase($context);
        return $ok;
    }
    catch (Exception $e)
    {
        return false;
    }
}
