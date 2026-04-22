<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/ProductoController.php";

$datosProducto         = ConsultarProducto($_GET["id"]);
$datosCategoriasSelect = ConsultarCategorias();
?>

<!DOCTYPE html>
<html lang="es">

<?php MostrarCSS(); ?>

<body>

    <?php MostrarNav(); ?>

    <main class="main-wrapper" style="margin-left:0;">

        <!-- Banner -->
        <div style="background: linear-gradient(135deg, #2ECC71 0%, #1A8A4A 100%); padding: 40px 0 60px;">
            <div class="container text-center text-white">
                <div class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:80px;height:80px;">
                    <i class="lni lni-pencil-alt" style="font-size:40px;color:#2ECC71;"></i>
                </div>
                <h3 class="fw-bold mb-1">Actualizar Producto</h3>
                <p class="mb-0" style="opacity:.85;">Modifica la información del producto</p>
            </div>
        </div>

        <section class="section" style="margin-top:-30px; padding-bottom: 60px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm" style="border-radius:16px; overflow:hidden;">
                            <div class="card-body p-4 p-md-5">

                                <?php
                                if (isset($_POST["Mensaje"])) {
                                    $tipoAlerta = $_POST["TipoMensaje"] ?? 'danger';
                                    $icono = $tipoAlerta === 'success' ? 'lni-checkmark-circle' : 'lni-information';
                                    echo '<div class="alert alert-' . $tipoAlerta . ' d-flex align-items-center gap-2 mb-4" role="alert">'
                                        . '<i class="lni ' . $icono . '"></i>'
                                        . '<span>' . htmlspecialchars($_POST["Mensaje"], ENT_QUOTES, 'UTF-8') . '</span>'
                                        . '</div>';
                                }
                                ?>

                                <form id="formActualizarProducto" action="" method="POST" enctype="multipart/form-data" novalidate>

                                    <input type="hidden" name="id_producto" value="<?php echo (int)$datosProducto['id_producto']; ?>">

                                    <div class="row g-3">

                                        <!-- Categoría -->
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Categoría</label>
                                            <select class="form-select" id="id_categoria" name="id_categoria" required>
                                                <option value="">Seleccione una categoría</option>
                                                <?php foreach ($datosCategoriasSelect as $cat): ?>
                                                    <option value="<?php echo (int)$cat['id_categoria']; ?>"
                                                        <?php echo (int)$cat['id_categoria'] === (int)$datosProducto['id_categoria'] ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($cat['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="text-danger"></span>
                                        </div>

                                        <!-- Nombre -->
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                   placeholder="Nombre del producto"
                                                   value="<?php echo htmlspecialchars($datosProducto['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
                                            <span class="text-danger"></span>
                                        </div>

                                        <!-- Descripción -->
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Descripción</label>
                                            <textarea class="form-control" id="descripcion" name="descripcion"
                                                      rows="3" placeholder="Descripción del producto" required><?php echo htmlspecialchars($datosProducto['descripcion'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                                            <span class="text-danger"></span>
                                        </div>

                                        <!-- Precio y Stock -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Precio (₡)</label>
                                            <input type="text" class="form-control" id="precio" name="precio"
                                                   placeholder="0.00"
                                                   value="<?php echo number_format((float)$datosProducto['precio'], 2); ?>" required>
                                            <span class="text-danger"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Stock</label>
                                            <input type="text" class="form-control" id="stock" name="stock"
                                                   placeholder="0"
                                                   value="<?php echo (int)$datosProducto['stock']; ?>" required>
                                            <span class="text-danger"></span>
                                        </div>

                                        <!-- Talla y Color -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Talla <span class="text-muted fw-normal">(opcional)</span></label>
                                            <input type="text" class="form-control" name="talla"
                                                   placeholder="Ej: M, L, XL"
                                                   value="<?php echo htmlspecialchars($datosProducto['talla'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Color <span class="text-muted fw-normal">(opcional)</span></label>
                                            <input type="text" class="form-control" name="color"
                                                   placeholder="Ej: Negro, Rojo"
                                                   value="<?php echo htmlspecialchars($datosProducto['color'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                        </div>

                                        <!-- Imagen -->
                                        <div class="col-md-8">
                                            <label class="form-label fw-semibold">
                                                Imagen <span class="text-muted fw-normal">(dejar vacío para conservar la actual)</span>
                                            </label>
                                            <div class="d-flex align-items-center gap-3">
                                                <label for="ImagenProducto" class="btn fw-semibold mb-0"
                                                       style="background:#2ECC71;color:#fff;border-radius:8px;cursor:pointer;padding:8px 18px;">
                                                    <i class="lni lni-upload me-1"></i>Seleccionar
                                                </label>
                                                <span id="nombreArchivo" style="font-size:0.9rem;color:#666;">Ningún archivo seleccionado</span>
                                            </div>
                                            <input type="file" class="d-none" id="ImagenProducto" name="ImagenProducto" accept=".png,.jpg,.jpeg">
                                            <span class="text-danger" id="feedbackImagen"></span>
                                        </div>

                                        <!-- Imagen actual -->
                                        <div class="col-md-4 d-flex align-items-end">
                                            <?php if (!empty($datosProducto['imagen'])): ?>
                                                <img src="<?php echo htmlspecialchars($datosProducto['imagen'], ENT_QUOTES, 'UTF-8'); ?>"
                                                     alt="Imagen actual" width="100"
                                                     class="rounded shadow-sm border">
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Sin imagen</span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Botones -->
                                        <div class="col-12 d-flex gap-3 mt-2">
                                            <button type="submit" name="btnActualizarProducto" id="btnActualizarProducto"
                                                    class="btn fw-semibold flex-grow-1"
                                                    style="background:#2ECC71;color:#fff;border-radius:10px;padding:12px;">
                                                <i class="lni lni-checkmark-circle me-2"></i>Actualizar Producto
                                            </button>
                                            <a href="/G4_AmbienteWeb/Views/Producto/consultarProductos.php"
                                               class="btn btn-outline-secondary fw-semibold"
                                               style="border-radius:10px;padding:12px 24px;">
                                                <i class="lni lni-arrow-left me-1"></i>Cancelar
                                            </a>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php MostrarFooter(); ?>

    </main>

    <?php MostrarJS(); ?>
    <script src="../funciones/actualizarProducto.js"></script>

</body>
</html>
