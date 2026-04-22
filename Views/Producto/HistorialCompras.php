<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (session_status() === PHP_SESSION_NONE) session_start();

// RBAC - Solo clientes pueden ver sus pedidos
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/funciones/rbac.php";
RequiereCliente('/G4_AmbienteWeb/Views/Home/home.php');

include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/PedidoController.php";

$datos = ConsultarHistorial();

$pedidos = [];
if (!empty($datos) && is_array($datos)) {
    foreach ($datos as $row) {
        $id = $row['id_pedido'];
        if (!isset($pedidos[$id])) {
            $pedidos[$id] = [
                'id_pedido' => $id,
                'fecha_pedido' => $row['fecha_pedido'],
                'direccion' => $row['direccion'],
                'telefono' => $row['telefono'],
                'total' => $row['total'] ?? 0,
                'estado' => $row['estado'] ?? '',
                'metodo_pago' => $row['metodo_pago'] ?? '',
                'items' => []
            ];
        }
        $pedidos[$id]['items'][] = [
            'id_detalle' => $row['id_detalle'],
            'id_producto' => $row['id_producto'],
            'nombre' => $row['nombre_producto'],
            'imagen' => $row['imagen_producto'],
            'talla' => $row['talla_producto'],
            'color' => $row['color_producto'],
            'cantidad' => $row['cantidad'],
            'precio_unitario' => $row['precio_unitario'],
            'subtotal' => $row['subtotal']
        ];
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
        <div class="col-md-10">
            <h3 class="fw-bold mb-4">Historial de Compras</h3>

            <?php if (empty($pedidos)): ?>
                <div class="alert alert-info">No tienes pedidos registrados aún. <a href="/G4_AmbienteWeb/Views/Producto/tienda.php">Ir a la tienda</a></div>
            <?php else: ?>
                <?php foreach ($pedidos as $p): ?>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-white">
                            <div>
                                <strong>#<?php echo $p['id_pedido']; ?></strong>
                                <div class="small text-muted"><?php echo date('d/m/Y H:i', strtotime($p['fecha_pedido'])); ?></div>
                            </div>
                            <div class="text-end">
                                <div class="mb-1">
                                    <span class="badge <?php echo obtenerColorEstado($p['estado']); ?> fs-6 p-2 shadow-sm">
                                        <?php echo strtoupper($p['estado']); ?>
                                    </span>
                                </div>
                                <div class="fw-bold">Total: ₡<?php echo number_format((float)$p['total'],2); ?></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($p['items'] as $it): ?>
                                        <tr>
                                            <td>
                                                <div style="display:flex;gap:12px;align-items:center;">
                                                    <?php if (!empty($it['imagen'])): ?>
                                                        <img src="<?php echo htmlspecialchars($it['imagen']); ?>" alt="" style="width:70px;height:70px;object-fit:cover;border-radius:8px;">
                                                    <?php else: ?>
                                                        <div style="width:70px;height:70px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#999;">No img</div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <div class="fw-bold"><?php echo htmlspecialchars($it['nombre']); ?></div>
                                                        <small class="text-muted"><?php echo htmlspecialchars($it['talla']); ?> <?php echo htmlspecialchars($it['color']); ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo (int)$it['cantidad']; ?></td>
                                            <td>₡<?php echo number_format((float)$it['precio_unitario'],2); ?></td>
                                            <td>₡<?php echo number_format((float)$it['subtotal'],2); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 d-flex justify-content-between">
                                <div>
                                    <small class="text-muted">Dirección: <?php echo htmlspecialchars($p['direccion']); ?></small>
                                </div>
                                <div>
                                    <a href="consultarPedido.php?id=<?php echo $p['id_pedido']; ?>" class="btn btn-sm btn-outline-success">Ver detalle</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php MostrarFooter(); ?>
<?php MostrarJS(); ?>
</body>
</html>
