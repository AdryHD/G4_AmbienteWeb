<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (session_status() === PHP_SESSION_NONE) session_start();

// RBAC - Solo clientes pueden ver la tienda de productos
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Views/funciones/rbac.php";
RequiereCliente('/G4_AmbienteWeb-main/Views/Home/home.php');

include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Controllers/ProductoController.php";

$datosProductos = ConsultarProductos();

// Agrupar por categoría (solo activos)
$categorias = [
    1 => ['nombre' => 'Ropa Deportiva',     'icono' => 'mdi mdi-tshirt-crew',   'color' => '#2ECC71'],
    2 => ['nombre' => 'Zapatos Deportivos',  'icono' => 'mdi mdi-shoe-sneaker',  'color' => '#2ECC71'],
    3 => ['nombre' => 'Accesorios',          'icono' => 'mdi mdi-bag-personal',  'color' => '#2ECC71'],
];

$productosPorCat = [1 => [], 2 => [], 3 => []];
$productosOferta  = [];

if (!empty($datosProductos)) {
    foreach ($datosProductos as $p) {
        if ($p['estado'] === 'activo') {
            $idCat = (int)$p['id_categoria'];
            if (isset($productosPorCat[$idCat])) {
                $productosPorCat[$idCat][] = $p;
            }
            if ((int)$p['en_oferta'] === 1) {
                $productosOferta[] = $p;
            }
        }
    }
}

// Filtro desde URL: 0=todos, 1-3=categoría, 99=ofertas
$filtro = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;
?>
<!DOCTYPE html>
<html lang="es">
<?php MostrarCSS(); ?>
<body>
<?php MostrarNav(); ?>

<!-- Banner -->
<div style="background: linear-gradient(135deg, #1A1A1A 0%, #000 100%); padding: 50px 0 70px; position:relative; overflow:hidden;">
    <div style="position:absolute;top:-40px;right:-40px;width:250px;height:250px;background:rgba(46,204,113,0.1);border-radius:50%;filter:blur(40px);"></div>
    <div class="container text-center text-white position-relative">
        <i class="lni lni-shopping-basket mb-3" style="font-size:50px;color:#2ECC71;display:block;"></i>
        <h1 class="fw-bold mb-2" style="font-size:2.5rem;color:#fff;">Nuestros Productos</h1>
        <p style="color:#CCCCCC;font-size:1.1rem;">Equipamiento deportivo premium para tu rendimiento</p>

        <!-- Filtros de categoría -->
        <div class="d-flex justify-content-center gap-2 mt-4 flex-wrap">
            <a href="tienda.php" class="btn fw-semibold px-4 py-2 <?php echo $filtro === 0 ? 'btn-success' : 'btn-outline-light'; ?>"
               style="border-radius:50px; <?php echo $filtro === 0 ? 'background:#2ECC71;border:none;' : 'border:2px solid rgba(255,255,255,0.4);'; ?>">
                Todos
            </a>
            <a href="tienda.php?cat=99"
               class="btn fw-semibold px-4 py-2 <?php echo $filtro === 99 ? 'btn-warning' : 'btn-outline-light'; ?>"
               style="border-radius:50px; <?php echo $filtro === 99 ? 'background:#f39c12;border:none;color:#fff;' : 'border:2px solid rgba(255,255,255,0.4);'; ?>">
                <i class="lni lni-offer me-1"></i>Ofertas
            </a>
            <?php foreach ($categorias as $idCat => $cat): ?>
            <a href="tienda.php?cat=<?php echo $idCat; ?>"
               class="btn fw-semibold px-4 py-2 <?php echo $filtro === $idCat ? 'btn-success' : 'btn-outline-light'; ?>"
               style="border-radius:50px; <?php echo $filtro === $idCat ? 'background:#2ECC71;border:none;' : 'border:2px solid rgba(255,255,255,0.4);'; ?>">
                <i class="<?php echo $cat['icono']; ?> me-1"></i><?php echo htmlspecialchars($cat['nombre']); ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<main style="background:#F8F9FA; margin-top:-30px; padding-bottom:60px; min-height:60vh;">
<div class="container" style="padding-top:20px;">

<?php
// Decidir qué mostrar según filtro
$mostrarOfertas = ($filtro === 99);
$catsAMostrar   = (!$mostrarOfertas && $filtro > 0 && isset($categorias[$filtro]))
    ? [$filtro => $categorias[$filtro]]
    : ($mostrarOfertas ? [] : $categorias);

$hayProductos = $mostrarOfertas
    ? !empty($productosOferta)
    : (function() use ($catsAMostrar, $productosPorCat) {
        foreach ($catsAMostrar as $idCat => $_) {
            if (!empty($productosPorCat[$idCat])) return true;
        }
        return false;
    })();
?>

<?php if (!$hayProductos): ?>
    <div class="text-center py-5">
        <i class="lni lni-empty-file" style="font-size:60px;color:#CCC;display:block;margin-bottom:16px;"></i>
        <h4 style="color:#999;">No hay productos disponibles<?php echo $mostrarOfertas ? ' en ofertas' : ' en esta categoría'; ?></h4>
        <p style="color:#BBB;">Pronto agregaremos nuevos artículos</p>
    </div>
<?php else: ?>

<?php if ($mostrarOfertas): ?>
    <!-- Encabezado Ofertas -->
    <div class="d-flex align-items-center gap-3 mt-5 mb-4" style="border-bottom:2px solid #f39c12; padding-bottom:12px;">
        <div style="width:48px;height:48px;background:linear-gradient(135deg,#f39c12,#e67e22);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="lni lni-offer" style="font-size:26px;color:#fff;"></i>
        </div>
        <div>
            <h3 class="fw-bold mb-0" style="color:#1A1A1A;">Ofertas Especiales</h3>
            <small style="color:#666;"><?php echo count($productosOferta); ?> producto(s) en oferta</small>
        </div>
    </div>
    <div class="row g-4">
        <?php foreach ($productosOferta as $producto):
            $idCat = (int)$producto['id_categoria'];
            $cat   = $categorias[$idCat] ?? ['icono' => 'lni lni-tag']; ?>
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card h-100 border-0 shadow-sm" style="border-radius:16px;overflow:hidden;transition:transform .25s,box-shadow .25s;"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 30px rgba(0,0,0,0.12)'"
                 onmouseout="this.style.transform='';this.style.boxShadow=''">
                <!-- Imagen -->
                <div style="height:200px;background:#F0F0F0;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                    <?php if (!empty($producto['imagen'])): ?>
                        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>"
                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                             style="width:100%;height:100%;object-fit:cover;">
                    <?php else: ?>
                        <div style="text-align:center;">
                            <i class="<?php echo $cat['icono']; ?>" style="font-size:60px;color:#DDD;display:block;margin-bottom:8px;"></i>
                            <small style="color:#CCC;">Sin imagen</small>
                        </div>
                    <?php endif; ?>
                    <span class="badge" style="position:absolute;top:10px;left:10px;background:#f39c12;font-size:0.7rem;padding:4px 8px;border-radius:50px;">
                        <i class="lni lni-offer me-1"></i>Oferta
                    </span>
                    <?php if ((int)$producto['stock'] <= 5 && (int)$producto['stock'] > 0): ?>
                        <span class="badge" style="position:absolute;top:10px;right:10px;background:#FF6B35;font-size:0.7rem;padding:4px 8px;border-radius:50px;">¡Últimas <?php echo (int)$producto['stock']; ?>!</span>
                    <?php elseif ((int)$producto['stock'] === 0): ?>
                        <span class="badge" style="position:absolute;top:10px;right:10px;background:#666;font-size:0.7rem;padding:4px 8px;border-radius:50px;">Agotado</span>
                    <?php endif; ?>
                </div>
                <!-- Cuerpo -->
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="fw-bold mb-1" style="color:#1A1A1A;font-size:1rem;line-height:1.3;"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                    <p class="text-muted mb-3" style="font-size:0.85rem;line-height:1.4;flex-grow:1;"><?php echo htmlspecialchars($producto['descripcion'] ?? ''); ?></p>
                    <div class="d-flex gap-2 mb-3 flex-wrap">
                        <?php if (!empty($producto['talla'])): ?>
                            <span style="background:#F0F0F0;color:#555;font-size:0.75rem;padding:3px 10px;border-radius:50px;font-weight:600;">Talla: <?php echo htmlspecialchars($producto['talla']); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($producto['color'])): ?>
                            <span style="background:#F0F0F0;color:#555;font-size:0.75rem;padding:3px 10px;border-radius:50px;font-weight:600;"><?php echo htmlspecialchars($producto['color']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold" style="font-size:1.25rem;color:#f39c12;">₡<?php echo number_format((float)$producto['precio'], 2); ?></span>
                        <small style="color:#999;">Stock: <?php echo (int)$producto['stock']; ?></small>
                    </div>
                    <button class="btn w-100 fw-semibold"
                            style="background:#111;border:none;color:#fff;border-radius:10px;padding:10px;font-size:0.9rem;"
                            <?php echo (int)$producto['stock'] === 0 ? 'disabled' : ''; ?>
                            onclick="agregarAlCarrito(<?php echo (int)$producto['id_producto']; ?>, '<?php echo htmlspecialchars(addslashes($producto['nombre'])); ?>', this)">
                        <i class="lni lni-cart me-1"></i><?php echo (int)$producto['stock'] === 0 ? 'Agotado' : 'Agregar al carrito'; ?>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>

<?php foreach ($catsAMostrar as $idCat => $cat):
    if (empty($productosPorCat[$idCat])) continue; ?>

    <!-- Encabezado de categoría -->
    <div class="d-flex align-items-center gap-3 mt-5 mb-4" style="border-bottom:2px solid #2ECC71; padding-bottom:12px;">
        <div style="width:48px;height:48px;background:linear-gradient(135deg,#2ECC71,#1a8a4a);border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="<?php echo $cat['icono']; ?>" style="font-size:26px;color:#fff;"></i>
        </div>
        <div>
            <h3 class="fw-bold mb-0" style="color:#1A1A1A;"><?php echo htmlspecialchars($cat['nombre']); ?></h3>
            <small style="color:#666;"><?php echo count($productosPorCat[$idCat]); ?> producto(s) disponible(s)</small>
        </div>
    </div>

    <div class="row g-4">
        <?php foreach ($productosPorCat[$idCat] as $producto): ?>
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card h-100 border-0 shadow-sm" style="border-radius:16px;overflow:hidden;transition:transform .25s,box-shadow .25s;"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 30px rgba(0,0,0,0.12)'"
                 onmouseout="this.style.transform='';this.style.boxShadow=''">

                <!-- Imagen -->
                <div style="height:200px;background:#F0F0F0;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                    <?php if (!empty($producto['imagen'])): ?>
                        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>"
                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                             style="width:100%;height:100%;object-fit:cover;">
                    <?php else: ?>
                        <div style="text-align:center;color:#CCC;">
                            <i class="<?php echo $cat['icono']; ?>" style="font-size:60px;color:#DDD;display:block;margin-bottom:8px;"></i>
                            <small style="color:#CCC;">Sin imagen</small>
                        </div>
                    <?php endif; ?>
                    <!-- Badge stock -->
                    <?php if ((int)$producto['stock'] <= 5 && (int)$producto['stock'] > 0): ?>
                        <span class="badge" style="position:absolute;top:10px;right:10px;background:#FF6B35;font-size:0.7rem;padding:4px 8px;border-radius:50px;">
                            ¡Últimas <?php echo (int)$producto['stock']; ?>!
                        </span>
                    <?php elseif ((int)$producto['stock'] === 0): ?>
                        <span class="badge" style="position:absolute;top:10px;right:10px;background:#666;font-size:0.7rem;padding:4px 8px;border-radius:50px;">
                            Agotado
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Cuerpo -->
                <div class="card-body d-flex flex-column p-4">
                    <h5 class="fw-bold mb-1" style="color:#1A1A1A;font-size:1rem;line-height:1.3;">
                        <?php echo htmlspecialchars($producto['nombre']); ?>
                    </h5>
                    <p class="text-muted mb-3" style="font-size:0.85rem;line-height:1.4;flex-grow:1;">
                        <?php echo htmlspecialchars($producto['descripcion'] ?? ''); ?>
                    </p>

                    <!-- Talla / Color -->
                    <div class="d-flex gap-2 mb-3 flex-wrap">
                        <?php if (!empty($producto['talla'])): ?>
                            <span style="background:#F0F0F0;color:#555;font-size:0.75rem;padding:3px 10px;border-radius:50px;font-weight:600;">
                                Talla: <?php echo htmlspecialchars($producto['talla']); ?>
                            </span>
                        <?php endif; ?>
                        <?php if (!empty($producto['color'])): ?>
                            <span style="background:#F0F0F0;color:#555;font-size:0.75rem;padding:3px 10px;border-radius:50px;font-weight:600;">
                                <?php echo htmlspecialchars($producto['color']); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Precio -->
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="fw-bold" style="font-size:1.25rem;color:#2ECC71;">
                            ₡<?php echo number_format((float)$producto['precio'], 2); ?>
                        </span>
                        <small style="color:#999;">Stock: <?php echo (int)$producto['stock']; ?></small>
                    </div>

                    <!-- Botón agregar al carrito -->
                    <button class="btn w-100 fw-semibold"
                            style="background:#111;border:none;color:#fff;border-radius:10px;padding:10px;font-size:0.9rem;transition:opacity .2s;"
                            <?php echo (int)$producto['stock'] === 0 ? 'disabled' : ''; ?>
                            onclick="agregarAlCarrito(<?php echo (int)$producto['id_producto']; ?>, '<?php echo htmlspecialchars(addslashes($producto['nombre'])); ?>', this)"
                            onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        <i class="lni lni-cart me-1"></i>
                        <?php echo (int)$producto['stock'] === 0 ? 'Agotado' : 'Agregar al carrito'; ?>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

<?php endforeach; ?>
<?php endif; // fin else (categorías vs ofertas) ?>
<?php endif; // fin hayProductos ?>

</div>
</main>

<?php MostrarFooter(); ?>
<?php MostrarJS(); ?>



<script>
function _updateCartBadge() {
    fetch('/G4_AmbienteWeb/Controllers/CarritoController.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({action: 'contar'})
    })
    .then(r => r.json())
    .then(data => {
        if (data && typeof data.total !== 'undefined') {
            const badge = document.getElementById('cart-badge');
            if (badge) badge.textContent = data.total;
        }
    }).catch(()=>{});
}

function agregarAlCarrito(idProducto, nombre, btn) {
    const original = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="lni lni-checkmark-circle me-1"></i>Agregado';
    btn.style.background = 'linear-gradient(135deg,#27a654,#1a7a3f)';

    fetch('/G4_AmbienteWeb/Controllers/CarritoController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: new URLSearchParams({action: 'agregar', id_producto: idProducto, cantidad: 1})
    })
    .then(r => {
        try { return r.json(); } catch (e) { return null; }
    })
    .then(resp => {
        if (resp && resp.error) {
            if (typeof showToast === 'function') showToast(resp.error, 'danger', 1200);
        } else {
            if (typeof showToast === 'function') showToast('Producto agregado al carrito', 'success', 700);
            _updateCartBadge();
        }
        setTimeout(() => location.reload(), 900);
    })
    .catch(() => {
        if (typeof showToast === 'function') showToast('Error al agregar el producto al carrito.', 'danger', 1200);
    })
    .finally(() => {
        setTimeout(() => {
            btn.disabled = false;
            btn.innerHTML = original;
            btn.style.background = '#111';
        }, 900);
    });
}
</script>

</body>
</html>
