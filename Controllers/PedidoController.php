<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/PedidoModel.php";

function ConsultarPedido($idPedido = null)
{

    if ($idPedido !== null) {
        $idPedido = filter_var($idPedido, FILTER_VALIDATE_INT);
        

        if ($idPedido === false) {
            return null;
        }
    }


    $resultado = ConsultarPedidoModel($idPedido);

    if ($resultado == null || empty($resultado)) {
        return []; 
    }

    return $resultado;
}

