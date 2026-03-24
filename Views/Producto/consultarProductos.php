<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/ProductoController.php";

$datosProductos        = ConsultarProductos();
$datosCategoriasSelect = ConsultarCategorias();
$esAdmin = isset($_SESSION["usuario_rol"]) && $_SESSION["usuario_rol"] == 1;
?>

<!DOCTYPE html>
<html lang="es">

<?php MostrarCSS(); ?>

<body>

    <?php MostrarNav(); ?>

    <main class="main-wrapper" style="margin-left:0;">

        <!-- Banner de productos -->
        <div style="background: linear-gradient(135deg, #2ECC71 0%, #1A8A4A 100%); padding: 40px 0 60px;">
            <div class="container text-center text-white">
                <div class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:80px;height:80px;">
                    <i class="lni lni-shopping-basket" style="font-size:40px;color:#2ECC71;"></i>
                </div>
                <h3 class="fw-bold mb-1">Catálogo de Productos</h3>
                <p class="mb-0" style="opacity:.85;">Gestión del inventario deportivo PowerZone</p>
            </div>
        </div>

        <section class="section" style="margin-top:-30px; padding-bottom: 60px;">
            <div class="container-fluid px-4">

                <?php
                if (isset($_POST["Mensaje"])) {
                    $tipoAlerta = $_POST["TipoMensaje"] ?? 'info';
                    $icono = $tipoAlerta === 'success' ? 'lni-checkmark-circle' : 'lni-information';
                    echo '<div class="alert alert-' . $tipoAlerta . ' d-flex align-items-center gap-2 mb-4" role="alert">'
                        . '<i class="lni ' . $icono . '"></i>'
                        . '<span>' . htmlspecialchars($_POST["Mensaje"], ENT_QUOTES, 'UTF-8') . '</span>'
                        . '</div>';
                }
                ?>

                <div class="card shadow border-0">
                    <div class="card-header bg-white border-bottom pt-4 pb-3 px-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-0 fw-bold"><i class="lni lni-list me-2" style="color:#2ECC71;"></i>Listado de Productos</h5>
                            <small class="text-muted">Total: <?php echo count($datosProductos ?? []); ?> producto(s) registrado(s)</small>
                        </div>
                        <?php if ($esAdmin): ?>
                        <button type="button" class="btn text-white fw-semibold" style="background:#2ECC71; border:none;"
                                data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
                            <i class="lni lni-plus me-1"></i>Agregar Producto
                        </button>
                        <?php endif; ?>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead style="background:#f8f9fa;">
                                    <tr>
                                        <th class="px-4 py-3">#</th>
                                        <th class="py-3">Nombre</th>
                                        <th class="py-3">Descripción</th>
                                        <th class="py-3">Precio</th>
                                        <th class="py-3">Stock</th>
                                        <th class="py-3">Talla</th>
                                        <th class="py-3">Color</th>
                                        <th class="py-3">Estado</th>
                                        <th class="py-3">Imagen</th>
                                        <th class="py-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($datosProductos)) {
                                    foreach ($datosProductos as $producto) {
                                        $imagen = !empty($producto['imagen'])
                                            ? '<img src="' . htmlspecialchars($producto['imagen'], ENT_QUOTES, 'UTF-8') . '" alt="Imagen" width="55" class="rounded shadow-sm">'
                                            : '<span class="badge bg-secondary">Sin imagen</span>';

                                        $esActivo = strtolower($producto['EstadoDescripcion']) === 'activo';
                                        $estadoBadge = $esActivo
                                            ? '<span class="badge rounded-pill" style="background:#2ECC71;">Activo</span>'
                                            : '<span class="badge rounded-pill bg-secondary">Inactivo</span>';

                                        echo '
                                        <tr>
                                            <td class="px-4 text-muted fw-semibold">' . $producto['id_producto'] . '</td>
                                            <td class="fw-semibold">' . htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8') . '</td>
                                            <td class="text-muted" style="max-width:200px;">' . htmlspecialchars($producto['descripcion'] ?? '-', ENT_QUOTES, 'UTF-8') . '</td>
                                            <td class="fw-semibold" style="color:#1A8A4A;">₡' . number_format($producto['precio'], 2) . '</td>
                                            <td>' . $producto['stock'] . '</td>
                                            <td>' . htmlspecialchars($producto['talla'] ?? '-', ENT_QUOTES, 'UTF-8') . '</td>
                                            <td>' . htmlspecialchars($producto['color'] ?? '-', ENT_QUOTES, 'UTF-8') . '</td>
                                            <td>' . $estadoBadge . '</td>
                                            <td>' . $imagen . '</td>
                                            <td class="text-center">
                                                <form action="" method="POST" style="display:inline;">
                                                    <input type="hidden" name="id_producto" value="' . $producto['id_producto'] . '">
                                                    <button name="btnCambiarEstado" type="submit"
                                                        class="btn btn-sm fw-semibold"
                                                        style="background:#f0fdf4; color:#1A8A4A; border:1px solid #2ECC71;"
                                                        title="Cambiar Estado">
                                                        <i class="lni lni-reload me-1"></i>' . ($esActivo ? 'Desactivar' : 'Activar') . '
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="10" class="text-center text-muted py-5">
                                        <i class="lni lni-shopping-basket d-block mb-2" style="font-size:2rem;opacity:.4;"></i>
                                        No hay productos registrados.
                                    </td></tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <?php MostrarFooter(); ?>

    </main>

    <?php MostrarJS(); ?>

<?php if ($esAdmin): ?>
<!-- Modal Agregar Producto -->
<div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="modalAgregarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form method="POST" action="">
                <div class="modal-header" style="background:#2ECC71;">
                    <h5 class="modal-title text-white fw-bold" id="modalAgregarProductoLabel">
                        <i class="lni lni-plus me-2"></i>Agregar Nuevo Producto
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Categoría <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_categoria" required>
                                <option value="">Seleccione una categoría</option>
                                <?php foreach ($datosCategoriasSelect as $cat): ?>
                                <option value="<?php echo $cat['id_categoria']; ?>">
                                    <?php echo htmlspecialchars($cat['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre del producto" required maxlength="120">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="2" placeholder="Descripción del producto" maxlength="500"></textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Precio (₡) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="precio" placeholder="0.00" min="0" step="0.01" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Stock <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="stock" placeholder="0" min="0" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Talla</label>
                            <input type="text" class="form-control" name="talla" placeholder="XS/S/M/L/XL" maxlength="5">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Color</label>
                            <input type="text" class="form-control" name="color" placeholder="Color" maxlength="30">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">URL de Imagen</label>
                            <input type="text" class="form-control" name="imagen" placeholder="/G4_AmbienteWeb/Views/assets/images/products/imagen.png" maxlength="255">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btnAgregarProducto" class="btn text-white fw-semibold" style="background:#2ECC71; border:none;">
                        <i class="lni lni-checkmark me-1"></i>Guardar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

</body>

</html>
