<?php
// Evitar que el browser cachee páginas protegidas (impide volver atrás al login)
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
require_once __DIR__ . "/../../bootstrap.php";
include_once APP_FS_ROOT . "/Views/layout.php";
include_once APP_FS_ROOT . "/Controllers/ProductoController.php";
include_once APP_FS_ROOT . "/Views/Seguridad/role_guard.php";

$esAdmin = isAdmin();

$datosProductos = [];
$productosDestacados = [];

if (!$esAdmin) {
    $datosProductos = ConsultarProductos();

    if (!empty($datosProductos)) {
        foreach ($datosProductos as $producto) {
            if (($producto['estado'] ?? '') === 'activo') {
                $productosDestacados[] = $producto;
            }
        }
    }

    $productosDestacados = array_slice($productosDestacados, 0, 4);
}
?>

<!DOCTYPE html>
<html lang="es">

<?php MostrarCSS(); ?>

<body>

    <?php MostrarNav(); ?>

    <?php
    if (!empty($_SESSION['mensaje'])) {
        $msg  = $_SESSION['mensaje'];
        $type = $_SESSION['tipo_mensaje'] ?? 'info';
        unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);
        echo '<div class="alert alert-' . $type . ' alert-dismissible fade show m-3" role="alert">'
           . '<i class="lni lni-checkmark-circle me-2"></i>' . htmlspecialchars($msg)
           . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
    }
    ?>

    <?php if ($esAdmin): ?>
      <div class="container py-4">
        <div class="alert alert-dark border-success" style="border-width:2px;">
          <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
              <h4 class="mb-1"><i class="lni lni-shield me-2"></i>Panel de administración</h4>
              <div class="text-muted">
                Estás autenticado como <strong>ADMIN</strong> (<code>id_rol = 1</code>). Aquí gestionas pedidos, productos y usuarios.
              </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
              <a class="btn btn-success" href="<?php echo APP_BASE_URL; ?>/Views/Producto/consultarPedido.php"><i class="lni lni-package me-1"></i>Pedidos</a>
              <a class="btn btn-outline-success" href="<?php echo APP_BASE_URL; ?>/Views/Producto/consultarProductos.php"><i class="lni lni-shopping-basket me-1"></i>Productos</a>
              <a class="btn btn-outline-light border" href="<?php echo APP_BASE_URL; ?>/Views/Seguridad/gestionarUsuarios.php"><i class="lni lni-users me-1"></i>Usuarios</a>
            </div>
          </div>
          <hr class="my-3">
          <div class="small text-muted mb-0">
            Nota: la experiencia de <strong>tienda/carrito</strong> está oculta para administradores (sigue bloqueada en servidor con <code>requireCliente()</code>).
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!$esAdmin): ?>
    <!-- Hero Section -->
    <section class="hero-section py-2" style="background: linear-gradient(135deg, #1A1A1A 0%, #000000 100%); position: relative; overflow: hidden;">
      <!-- Background decoration -->
      <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(46, 204, 113, 0.1); border-radius: 50%; filter: blur(40px);"></div>
      <div style="position: absolute; bottom: -30px; left: -30px; width: 250px; height: 250px; background: rgba(46, 204, 113, 0.05); border-radius: 50%; filter: blur(40px);"></div>
      
      <div class="container-fluid position-relative z-2 px-4 px-lg-5">
        <div class="row align-items-center text-white py-2">
          <div class="col-lg-8 hero-copy">
            <h1 class="display-3 fw-bold mb-3" style="color: #FFFFFF; line-height: 1.2; font-size: 3.5rem;">Equipamiento Deportivo Premium</h1>
            <p class="lead mb-4" style="font-size: 1.2rem; color: #CCCCCC; line-height: 1.6;">Descubre las mejores marcas en ropa y zapatos deportivos. Envío gratis en compras mayores a $50.</p>
            <div class="d-flex gap-3 flex-wrap">
              <a href="#productos" class="btn btn-success btn-lg" style="background: linear-gradient(135deg, #2ECC71 0%, #27a654 100%); border: none; font-weight: 600; padding: 12px 28px;">
                <i class="lni lni-shopping-basket me-2"></i>Productos Destacados
              </a>
              <a href="#categorias" class="btn btn-outline-light btn-lg" style="border: 2px solid white; font-weight: 600; padding: 10px 28px; transition: all 0.3s ease;">
                <i class="lni lni-list me-2"></i>Categorías
              </a>
            </div>
          </div>
          <div class="col-lg-4 d-none d-lg-flex align-items-center justify-content-center hero-logo-wrap">
            <img src="../assets/images/00logo1.png" alt="PowerZone Logo" style="width: 100%; max-width: 380px; height: auto; border-radius: 10px;">
          </div>
        </div>
      </div>
    </section>

    <!-- Categorías -->
    <section class="py-5" id="categorias" style="background: #FAFAFA;">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="fw-bold" style="font-size: 2.5rem; color: #1A1A1A; margin-bottom: 15px;">Categorías Destacadas</h2>
          <p style="color: #666666; font-size: 1.1rem;">Encuentra lo que buscas en nuestros productos especializados</p>
        </div>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; transition: all 0.3s ease; overflow: hidden;">
              <div class="card-body text-center p-5" style="background: white;">
                <div class="mb-4">
                  <div style="width: 100px; height: 100px; margin: 0 auto; background: linear-gradient(135deg, #2ECC71 0%, rgba(46, 204, 113, 0.1) 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                    <i class="mdi mdi-tshirt-crew" style="font-size: 54px; color: #2ECC71;"></i>
                  </div>
                </div>
                <h4 class="card-title fw-bold" style="color: #1A1A1A; font-size: 1.3rem; margin-bottom: 10px;">Ropa Deportiva</h4>
                <p class="card-text" style="color: #666666; margin-bottom: 20px;">Camisetas, pantalones y más para tu entrenamiento</p>
                <a href="../Producto/tienda.php?cat=1" class="btn btn-outline-success" style="border: 2px solid #2ECC71; color: #2ECC71; font-weight: 600; transition: all 0.3s ease;">Ver más →</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; transition: all 0.3s ease; overflow: hidden;">
              <div class="card-body text-center p-5" style="background: white;">
                <div class="mb-4">
                  <div style="width: 100px; height: 100px; margin: 0 auto; background: linear-gradient(135deg, #2ECC71 0%, rgba(46, 204, 113, 0.1) 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                    <i class="mdi mdi-shoe-sneaker" style="font-size: 54px; color: #2ECC71;"></i>
                  </div>
                </div>
                <h4 class="card-title fw-bold" style="color: #1A1A1A; font-size: 1.3rem; margin-bottom: 10px;">Zapatos Deportivos</h4>
                <p class="card-text" style="color: #666666; margin-bottom: 20px;">Las mejores marcas en calzado deportivo</p>
                <a href="../Producto/tienda.php?cat=2" class="btn btn-outline-success" style="border: 2px solid #2ECC71; color: #2ECC71; font-weight: 600; transition: all 0.3s ease;">Ver más →</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; transition: all 0.3s ease; overflow: hidden;">
              <div class="card-body text-center p-5" style="background: white;">
                <div class="mb-4">
                  <div style="width: 100px; height: 100px; margin: 0 auto; background: linear-gradient(135deg, #2ECC71 0%, rgba(46, 204, 113, 0.1) 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                    <i class="mdi mdi-bag-personal" style="font-size: 54px; color: #2ECC71;"></i>
                  </div>
                </div>
                <h4 class="card-title fw-bold" style="color: #1A1A1A; font-size: 1.3rem; margin-bottom: 10px;">Accesorios</h4>
                <p class="card-text" style="color: #666666; margin-bottom: 20px;">Complementos para completar tu outfit deportivo</p>
                <a href="../Producto/tienda.php?cat=3" class="btn btn-outline-success" style="border: 2px solid #2ECC71; color: #2ECC71; font-weight: 600; transition: all 0.3s ease;">Ver más →</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Productos Destacados -->
    <section class="py-5" id="productos">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="fw-bold" style="font-size: 2.5rem; color: #1A1A1A; margin-bottom: 15px;">Productos Destacados</h2>
          <p style="color: #666666; font-size: 1.1rem;">Los mejores artículos seleccionados para ti</p>
        </div>
        <div class="row g-4">
          <?php if (!empty($productosDestacados)) { ?>
            <?php foreach ($productosDestacados as $producto) { ?>
              <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-0 shadow-sm product-card" style="border-radius: 15px; overflow: hidden;">
                  <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 250px; background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%); position: relative;">
                    <?php if (!empty($producto['imagen'])) { ?>
                      <img
                        src="<?php echo htmlspecialchars($producto['imagen'], ENT_QUOTES, 'UTF-8'); ?>"
                        alt="<?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>"
                        style="width: 100%; height: 100%; object-fit: cover;"
                      >
                    <?php } else { ?>
                      <i class="lni lni-shopping-basket" style="font-size: 80px; color: #2ECC71; opacity: 0.3;"></i>
                    <?php } ?>
                  </div>
                  <div class="card-body" style="background: white;">
                    <h5 class="card-title fw-bold" style="color: #1A1A1A; font-size: 1.1rem; margin-bottom: 8px;">
                      <?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                    </h5>
                    <p class="card-text" style="color: #666666; font-size: 0.95rem;">
                      <?php echo htmlspecialchars($producto['descripcion'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <span class="fs-5 fw-bold" style="color: #2ECC71;">
                        ₡<?php echo number_format((float)$producto['precio'], 2); ?>
                      </span>
                      <small style="color:#999;">Stock: <?php echo (int)$producto['stock']; ?></small>
                    </div>
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
            <?php } ?>
          <?php } else { ?>
            <div class="col-12 text-center py-5">
              <i class="lni lni-shopping-basket" style="font-size: 3rem; color: #999;"></i>
              <p class="mt-3 mb-0" style="color: #666;">No hay productos activos para mostrar.</p>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <!-- Ofertas Especiales -->
    <section class="py-5" id="ofertas" style="background: linear-gradient(135deg, #1A1A1A 0%, #000000 100%); position: relative; overflow: hidden;">
      <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(46, 204, 113, 0.1); border-radius: 50%; filter: blur(40px);"></div>
      
      <div class="container position-relative z-2">
        <div class="card border-0" style="border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
          <div class="card-body p-5 text-center" style="background: linear-gradient(135deg, #2ECC71 0%, #27a654 100%);">
            <h2 class="display-5 fw-bold mb-3" style="color: white; font-size: 2.5rem;">¡Ofertas Especiales del Mes!</h2>
            <p class="lead mb-4" style="color: rgba(255, 255, 255, 0.9); font-size: 1.15rem; font-weight: 500;">Aprovecha hasta 50% de descuento en productos seleccionados</p>
            <a href="<?php echo APP_BASE_URL; ?>/Views/Producto/tienda.php?cat=99" class="btn btn-dark btn-lg" style="background: #1A1A1A; border: none; color: white; font-weight: 600; padding: 14px 32px; transition: all 0.3s ease;">
              <i class="lni lni-offer me-2"></i>Ver Todas las Ofertas
            </a>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <?php MostrarFooter(); ?>

    <?php MostrarJS(); ?>
    <script>
      // Bloquear navegación hacia atrás: al presionar back se queda en home
      history.pushState(null, '', location.href);
      window.addEventListener('popstate', function() {
        history.pushState(null, '', location.href);
      });

      function agregarAlCarrito(idProducto, nombre, btn) {
          <?php if ($esAdmin): ?>
            return;
          <?php endif; ?>
          const original = btn.innerHTML;
          btn.disabled = true;
          btn.innerHTML = '<i class="lni lni-checkmark-circle me-1"></i>Agregado';
          btn.style.background = 'linear-gradient(135deg,#27a654,#1a7a3f)';

          fetch('<?php echo APP_BASE_URL; ?>/Controllers/CarritoController.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: new URLSearchParams({action: 'agregar', id_producto: idProducto, cantidad: 1})
          }).then(r => r.json())
          .then(() => {
            setTimeout(() => location.reload(), 700);
          }).catch(()=>{})
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
