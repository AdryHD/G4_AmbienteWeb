<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/PedidoController.php";

$idPedido = $_GET["id"] ?? null;
$datos = ConsultarPedido($idPedido);

$pedidosAgrupados = [];
if ($idPedido === null && !empty($datos)) {
    foreach ($datos as $fila) {
        $key = $fila['Fecha_pedido'] . $fila['Telefono']; 
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

            <?php if ($idPedido !== null): ?>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3><i class="lni lni-cart-full me-2"></i>Productos del Pedido</h3>
                    <a href="consultarPedido.php" class="btn btn-outline-primary btn-sm">Volver al Listado</a>
                </div>

                <div class="table-responsive shadow-sm">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th>Talla</th>
                                <th>Color</th>
                                <th>Cantidad</th>
                                <th>Stock Actual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos as $it): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($it['Nombre']); ?></strong></td>
                                <td><?php echo htmlspecialchars($it['Talla']); ?></td>
                                <td><?php echo htmlspecialchars($it['Color']); ?></td>
                                <td><?php echo $it['Cantidad']; ?></td>
                                <td><span class="badge bg-secondary"><?php echo $it['Stock']; ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="card bg-light mt-4 border-0">
                    <div class="card-body">
                        <h6 class="fw-bold border-bottom pb-2">Datos de Envío y Pago</h6>
                        <p class="mb-1"><strong>Dirección:</strong> <?php echo htmlspecialchars($datos[0]['Direccion']); ?></p>
                        <p class="mb-1"><strong>Teléfono:</strong> <?php echo htmlspecialchars($datos[0]['Telefono']); ?></p>
                        <p class="mb-1"><strong>Método de Pago:</strong> <?php echo htmlspecialchars($datos[0]['Metodo_pago']); ?></p>
                        <p class="mb-0"><strong>Estado:</strong> <span class="badge bg-info"><?php echo $datos[0]['Estado']; ?></span></p>
                    </div>
                </div>

            <?php else: ?>
                <h3 class="fw-bold mb-4">Gestión General de Pedidos</h3>
                
                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-hover bg-white">
                        <thead class="table-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidosAgrupados as $p): ?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i', strtotime($p['Fecha_pedido'])); ?></td>
                                <td><?php echo htmlspecialchars($p['Direccion']); ?></td>
                                <td><?php echo htmlspecialchars($p['Telefono']); ?></td>
                                <td><span class="badge bg-warning text-dark"><?php echo strtoupper($p['Estado']); ?></span></td>
                               <td>
                                <a href="consultarPedido.php?id=<?php echo $p['id_pedido']; ?>" class="btn btn-primary btn-sm">
                                    Ver Detalle
                                </a>
                            </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php MostrarFooter(); ?>
</body>
</html>