<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/PedidoModel.php";

if (isset($_POST["btnCambiarEstado"])) {
    $idPedido = $_POST["idPedido"];
    $nuevoEstado = $_POST["nuevoEstado"];

    if (!empty($idPedido) && !empty($nuevoEstado)) {
        $resultado = ActualizarEstadoPedidoModel($idPedido, $nuevoEstado);

        if ($resultado) {
            header("Location: consultarPedido.php?id=" . $idPedido);
            exit();
        }
    }
}
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

function ConsultarHistorial()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    $idUsuario = $_SESSION['usuario_id'] ?? null;
    if (!$idUsuario) return [];

    $resultado = ConsultarHistorialModel($idUsuario);
    if ($resultado == null || empty($resultado)) return [];
    return $resultado;
}