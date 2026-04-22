<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Controllers/CarritoController.php";

if (session_status() === PHP_SESSION_NONE) session_start();

$items = ObtenerCarrito();
$total = 0;
if (!empty($items)) {
    foreach ($items as $row) {
        $total += (float)$row['precio_unitario'] * (int)$row['cantidad'];
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
            <h3 class="fw-bold mb-4 text-center">Revisión de tu Pedido</h3>
            
            <div class="row g-4">
                <div class="col-md-7">
                    <div class="card shadow-sm border-0 rounded-3 mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold"><i class="lni lni-cart me-2"></i>Productos</h5>
                        </div>
                        <div class="card-body">
                            <?php foreach ($items as $it): ?>
                                <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                                    <img src="<?php echo $it['imagen']; ?>" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div class="ms-3 flex-grow-1">
                                        <h6 class="mb-0 fw-bold"><?php echo $it['nombre_producto']; ?></h6>
                                        <small class="text-muted">Cantidad: <?php echo $it['cantidad']; ?></small>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold">₡<?php echo number_format($it['precio_unitario'] * $it['cantidad'], 2); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="text-end pt-2">
                                <h5 class="fw-bold text-primary">Total: ₡<?php echo number_format($total, 2); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card shadow-sm border-0 rounded-3 bg-light">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Información de Entrega</h5>
                            <div id="resumenEnvio">
                                <p class="mb-1"><strong>Dirección:</strong> <span id="dispDireccion"></span></p>
                                <p class="mb-1"><strong>Teléfono:</strong> <span id="dispTelefono"></span></p>
                                <p class="mb-1"><strong>Método de Pago:</strong> <span id="dispMetodo" class="badge bg-dark"></span></p>
                                <hr>
                                <p class="small text-muted"><strong>Notas:</strong> <span id="dispNotas"></span></p>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button id="btnPasoFinal" class="btn btn-success btn-lg shadow">
                                    Proceder al Pago <i class="lni lni-arrow-right ms-2"></i>
                                </button>
                                <a href="carrito.php" class="btn btn-link text-muted btn-sm">Editar información</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php MostrarFooter(); ?>
<?php MostrarJS(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const datos = JSON.parse(localStorage.getItem('datos_envio'));

    if (!datos) {
        alert('No hay información del pedido.');
        window.location.href = 'carrito.php';
        return;
    }

    // Mostrar los datos en la vista
    document.getElementById('dispDireccion').innerText = datos.direccion;
    document.getElementById('dispTelefono').innerText = datos.telefono;
    document.getElementById('dispMetodo').innerText = datos.metodo_pago;
    document.getElementById('dispNotas').innerText = datos.observaciones || 'Ninguna';

    // Lógica del botón final
    document.getElementById('btnPasoFinal').addEventListener('click', function() {
        if (datos.metodo_pago === 'Tarjeta') {
            window.location.href = '/G4_AmbienteWeb-main/Views/Producto/pagoSimulado.php';
        } else {
            window.location.href = '/G4_AmbienteWeb-main/Views/Producto/transferencia.php';
        }
    });
});
</script>
</body>
</html>