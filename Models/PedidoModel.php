<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Models/UtilitarioModel.php";

function ConsultarPedidoModel($idPedido)
{
    $context = OpenDatabase();

    $param = ($idPedido === null) ? "NULL" : $idPedido;
    
    $sp = "CALL sp_ConsultarPedido($param)";
    $result = $context->query($sp);

    $datos = [];
    if($result) {
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }
    }
    CloseDatabase($context);
    return $datos;
}

function ActualizarEstadoPedidoModel($idPedido, $nuevoEstado)
{
    $context = OpenDatabase();
    $sql = "CALL sp_ActualizarEstadoPedido($idPedido, '$nuevoEstado')";
    
    $resultado = $context->query($sql);
    
    CloseDatabase($context);
    return $resultado;
}

function ConsultarHistorialModel($idUsuario)
{
    try {
        $context = OpenDatabase();

        $idUsuario = (int)$idUsuario;
        $sql = "SELECT 
                    PED.id_pedido,
                    PED.fecha_pedido,
                    PED.direccion,
                    PED.telefono,
                    PED.total,
                    PED.estado,
                    PED.metodo_pago,
                    DET.id_detalle,
                    DET.id_producto,
                    DET.cantidad,
                    DET.precio_unitario,
                    DET.subtotal,
                    PRO.nombre AS nombre_producto,
                    PRO.imagen AS imagen_producto,
                    PRO.talla AS talla_producto,
                    PRO.color AS color_producto
                 FROM pedidos PED
                 INNER JOIN pedido_detalle DET ON PED.id_pedido = DET.id_pedido
                 INNER JOIN productos PRO ON DET.id_producto = PRO.id_producto
                 WHERE PED.id_usuario = $idUsuario
                 ORDER BY PED.fecha_pedido DESC";

        $result = $context->query($sql);
        $datos = [];
        if ($result) {
            while ($fila = $result->fetch_assoc()) {
                $datos[] = $fila;
            }
        }

        CloseDatabase($context);
        return $datos;
    } catch (Exception $e) {
        return null;
    }
}