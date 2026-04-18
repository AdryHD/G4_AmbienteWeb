<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/UtilitarioController.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/CarritoModel.php";

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

function AgregarAlCarrito()
{
	$idUsuario  = $_SESSION["usuario_id"] ?? null;
	$idProducto = isset($_POST["id_producto"]) ? (int)$_POST["id_producto"] : null;
	$cantidad   = isset($_POST["cantidad"]) ? (int)$_POST["cantidad"] : 1;

	if (!$idUsuario || !$idProducto) {
		http_response_code(400);
		return ["error" => "Parámetros inválidos o usuario no autenticado."];
	}

	$result = AgregarAlCarritoModel($idUsuario, $idProducto, $cantidad);

	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
		header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}

	if ($result) {
		header("Location: /G4_AmbienteWeb/Views/Producto/tienda.php?msg=agregado");
		exit;
	}

	$_POST["Mensaje"]     = "No se pudo agregar el producto al carrito.";
	$_POST["TipoMensaje"] = "danger";
	return null;
}

function ObtenerCarrito()
{
	$idUsuario = $_SESSION["usuario_id"] ?? null;
	if (!$idUsuario) return null;
	return ObtenerCarritoModel($idUsuario);
}

function ActualizarCantidad()
{
	$idUsuario  = $_SESSION["usuario_id"] ?? null;
	$idDetalle  = isset($_POST["id_detalle"]) ? (int)$_POST["id_detalle"] : null;
	$cantidad   = isset($_POST["cantidad"]) ? (int)$_POST["cantidad"] : null;

	if (!$idUsuario || !$idDetalle || $cantidad === null) {
		http_response_code(400);
		return ["error" => "Parámetros inválidos."];
	}

	$result = ActualizarCantidadModel($idDetalle, $idUsuario, $cantidad);

	header('Content-Type: application/json');
	echo json_encode($result);
	exit;
}

function EliminarDelCarrito()
{
	$idUsuario = $_SESSION["usuario_id"] ?? null;
	$idDetalle = isset($_POST["id_detalle"]) ? (int)$_POST["id_detalle"] : null;

	if (!$idUsuario || !$idDetalle) {
		http_response_code(400);
		return ["error" => "Parámetros inválidos."];
	}

	$result = EliminarDelCarritoModel($idDetalle, $idUsuario);
	header('Content-Type: application/json');
	echo json_encode($result);
	exit;
}

function VaciarCarrito()
{
	$idUsuario = $_SESSION["usuario_id"] ?? null;
	if (!$idUsuario) {
		http_response_code(400);
		return ["error" => "Usuario no autenticado."];
	}

	$result = VaciarCarritoModel($idUsuario);
	header('Content-Type: application/json');
	echo json_encode($result);
	exit;
}

function CancelarCarrito()
{
	$idUsuario = $_SESSION["usuario_id"] ?? null;
	if (!$idUsuario) {
		http_response_code(400);
		return ["error" => "Usuario no autenticado."];
	}

	$result = CancelarCarritoModel($idUsuario);
	header('Content-Type: application/json');
	echo json_encode($result);
	exit;
}

function FinalizarCarrito()
{
    $idUsuario    = $_SESSION["usuario_id"] ?? null;
    $direccion    = $_POST["direccion"] ?? '';
    $telefono     = $_POST["telefono"] ?? '';
    $metodoPago   = $_POST["metodo_pago"] ?? '';
    $observaciones = $_POST["observaciones"] ?? '';

    if (!$idUsuario) {
        header('Content-Type: application/json');
        http_response_code(401); 
        echo json_encode(["error" => "Sesión expirada"]);
        exit;
    }

    $result = FinalizarCarritoModel($idUsuario, $direccion, $telefono, $metodoPago, $observaciones);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$action = $_POST['action'] ?? null;
	switch ($action) {
		case 'agregar': AgregarAlCarrito(); break;
		case 'contar':
			$userId = $_SESSION['usuario_id'] ?? null;
			header('Content-Type: application/json');
			if (!$userId) {
				echo json_encode(['error' => 'Usuario no autenticado']);
				exit;
			}
			$items = ObtenerCarritoModel($userId);
			$total = 0;
			if (is_array($items)) {
				foreach ($items as $it) {
					$total += isset($it['cantidad']) ? (int)$it['cantidad'] : 0;
				}
			}
			echo json_encode(['total' => $total]);
			exit;
			break;
		case 'actualizar': ActualizarCantidad(); break;
		case 'eliminar': EliminarDelCarrito(); break;
		case 'vaciar': VaciarCarrito(); break;
		case 'cancelar': CancelarCarrito(); break;
		case 'finalizar': FinalizarCarrito(); break;
	}
}
?>

