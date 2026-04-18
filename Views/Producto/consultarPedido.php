<?php
// Asegúrate de que la función obtenerColorEstado() esté en layout.php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/PedidoController.php";

$idPedido = $_GET["id"] ?? null;
$datos = ConsultarPedido($idPedido);

$pedidosAgrupados = [];
if ($idPedido === null && !empty($datos)) {
    foreach ($datos as $fila) {
        $key = $fila['id_pedido']; 
        if (!isset($pedidosAgrupados[$key])) {
            $pedidosAgrupados[$key] = $fila;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php MostrarCSS(); ?>
<body>
<?php MostrarNav(); ?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-11">

            <?php if ($idPedido !== null && !empty($datos)): ?>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="mb-0 text-dark">
                            <i class="lni lni-cart-full me-2 text-success"></i>Detalle del Pedido #<?php echo $idPedido; ?>
                        </h3>
                        <p class="text-muted">Cliente: <strong class="text-dark"><?php echo htmlspecialchars($datos[0]['Nombre_Cliente']); ?></strong></p>
                    </div>
                    <a href="consultarPedido.php" class="btn btn-success btn-sm px-3">
                        <i class="lni lni-arrow-left me-1"></i> Volver al Listado
                    </a>
                </div>

               <div class="table-responsive shadow-sm mb-4 border rounded bg-white p-4">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr class="text-dark small text-uppercase fw-bold border-bottom">
                                <th class="border-0 ps-0 py-3">Producto</th>
                                <th class="border-0 py-3">Talla</th>
                                <th class="border-0 py-3">Color</th>
                                <th class="border-0 py-3 text-center">Cantidad</th>
                                <th class="border-0 py-3 text-end pe-0">Stock Actual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $it): ?>
                            <tr class="border-bottom-0">
                                <td class="py-3 ps-0">
                                    <span class="fw-bold text-dark"><?php echo htmlspecialchars($it['Nombre_Producto']); ?></span>
                                </td>
                                <td class="py-3 text-muted"><?php echo htmlspecialchars($it['Talla']); ?></td>
                                <td class="py-3 text-muted"><?php echo htmlspecialchars($it['Color']); ?></td>
                                <td class="py-3 text-center text-muted"><?php echo $it['Cantidad']; ?></td>
                                <td class="py-3 text-end pe-0">
                                    <span class="badge bg-secondary px-3 opacity-75"><?php echo $it['Stock']; ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="fw-bold mb-0 text-success">
                            <i class="lni lni-delivery me-2"></i>Gestión de Logística y Entrega
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 border-end">
                                <p class="mb-2 text-muted small text-uppercase fw-bold">Información de Envío</p>
                                <p class="mb-1"><strong>Dirección:</strong> <?php echo htmlspecialchars($datos[0]['Direccion']); ?></p>
                                <p class="mb-1"><strong>Teléfono:</strong> <?php echo htmlspecialchars($datos[0]['Telefono']); ?></p>
                                <p class="mb-1"><strong>Pago:</strong> <?php echo htmlspecialchars($datos[0]['Metodo_pago']); ?></p>
                            </div>
                            <div class="col-md-6 ps-md-4">
                                <p class="mb-2 text-muted small text-uppercase fw-bold">Estado Actual</p>
                                <div class="mb-4">
                                    <span class="badge <?php echo obtenerColorEstado($datos[0]['Estado']); ?> fs-6 p-2 shadow-sm">
                                        <?php echo strtoupper($datos[0]['Estado']); ?>
                                    </span>
                                </div>
                                
                                <form method="POST" action="">
                                    <input type="hidden" name="idPedido" value="<?php echo $idPedido; ?>">
                                    
                                    <p class="mb-1 text-muted small text-uppercase fw-bold">Cambiar Estado</p>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-success text-white border-success">
                                            <i class="lni lni-cog"></i>
                                        </span>
                                        <select class="form-select border-success" name="nuevoEstado" id="nuevoEstado">
                                            <?php
                                            $estados = ['pendiente', 'empacado', 'enviado', 'entregado', 'cancelado'];
                                            $estadoActual = trim(strtolower($datos[0]['Estado']));

                                            foreach ($estados as $est) {
                                                $selected = ($est == $estadoActual) ? 'selected' : '';
                                                echo "<option value='$est' $selected>" . strtoupper($est) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" name="btnCambiarEstado" class="btn btn-success fw-bold py-2">
                                            <i class="lni lni-save me-2"></i>Actualizar Pedido
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php elseif ($idPedido === null): ?>
                <div class="mb-4">
                    <h3 class="fw-bold text-dark"><i class="lni lni-list me-2 text-success"></i>Gestión de Pedidos</h3>
                    <p class="text-muted">Panel de administración para el control de estados de venta.</p>
                </div>
                
                <div class="table-responsive shadow-sm rounded border">
                    <table class="table table-hover bg-white align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th># Pedido</th>
                                <th>Cliente</th>
                                <th>Fecha y Hora</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($pedidosAgrupados)): ?>
                                <tr><td colspan="6" class="text-center py-5 text-muted">No hay registros de pedidos.</td></tr>
                            <?php else: ?>
                                <?php foreach ($pedidosAgrupados as $p): ?>
                                <tr>
                                    <td><span class="fw-bold text-success">#<?php echo $p['id_pedido']; ?></span></td>
                                    <td><?php echo htmlspecialchars($p['Nombre_Cliente']); ?></td>
                                    <td class="small text-muted"><?php echo date('d/m/Y H:i', strtotime($p['Fecha_pedido'])); ?></td>
                                    <td><?php echo htmlspecialchars($p['Telefono']); ?></td>
                                    <td>
                                        <span class="badge <?php echo obtenerColorEstado($p['Estado']); ?> px-3 py-2">
                                            <?php echo strtoupper($p['Estado']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="consultarPedido.php?id=<?php echo $p['id_pedido']; ?>" class="btn btn-success btn-sm px-3 shadow-sm">
                                            <i class="lni lni-eye me-1"></i> Detalles
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning border-warning text-center shadow-sm">
                    <i class="lni lni-warning me-2"></i> No se encontró el pedido solicitado.
                </div>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php MostrarFooter(); ?>
<?php MostrarJS(); ?>
</body>
</html>