<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Models/UtilitarioModel.php";

function AgregarAlCarritoModel($idUsuario, $idProducto, $cantidad)
{
	try
	{
		$context = OpenDatabase();

		$sp = "CALL sp_AgregarAlCarrito('$idUsuario', '$idProducto', '$cantidad')";
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

function ObtenerCarritoModel($idUsuario)
{
	try
	{
		$context = OpenDatabase();

		$sp = "CALL sp_ObtenerCarrito('$idUsuario')";
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

function ActualizarCantidadModel($idDetalle, $idUsuario, $nuevaCantidad)
{
	try
	{
		$context = OpenDatabase();

		$sp = "CALL sp_ActualizarCantidad('$idDetalle', '$idUsuario', '$nuevaCantidad')";
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

function EliminarDelCarritoModel($idDetalle, $idUsuario)
{
	try
	{
		$context = OpenDatabase();

		$sp = "CALL sp_EliminarDelCarrito('$idDetalle', '$idUsuario')";
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

function VaciarCarritoModel($idUsuario)
{
	try
	{
		$context = OpenDatabase();

		$sp = "CALL sp_VaciarCarrito('$idUsuario')";
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

function CancelarCarritoModel($idUsuario)
{
	try
	{
		$context = OpenDatabase();

		$sp = "CALL sp_CancelarCarrito('$idUsuario')";
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

function FinalizarCarritoModel($idUsuario, $direccion, $telefono, $metodoPago, $observaciones)
{
    try {
        $context = OpenDatabase();
        $sp = "CALL sp_FinalizarCarrito('$idUsuario', '$direccion', '$telefono', '$metodoPago', '$observaciones')";
        $result = $context->query($sp);

        $datos = null;
        if ($result && $result->num_rows > 0) {
            $datos = $result->fetch_assoc();
        }

        CloseDatabase($context);
        return $datos;
    } catch (Exception $e) {
        return null;
    }
}

