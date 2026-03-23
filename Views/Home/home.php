<?php
// Evitar que el browser cachee páginas protegidas (impide volver atrás al login)
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
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

    <!-- Hero Section -->
    <section class="hero-section bg-gradient py-5" style="background: linear-gradient(135deg, #2ECC71 0%, #1A1A1A 100%);">
      <div class="container">
        <div class="row align-items-center text-white">
          <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-3">Equipamiento Deportivo de Alta Calidad</h1>
            <p class="lead mb-4">Descubre las mejores marcas en ropa y zapatos deportivos. Envío gratis en compras mayores a $50.</p>
            <a href="#productos" class="btn btn-light btn-lg">
              <i class="lni lni-shopping-basket me-2"></i>Ver Productos
            </a>
          </div>
          <div class="col-lg-6 text-center">
            <i class="lni lni-sport-alt" style="font-size: 200px; opacity: 0.3; color: #1A1A1A;"></i>
          </div>
        </div>
      </div>
    </section>

    <!-- Categorías -->
    <section class="py-5" id="categorias">
      <div class="container">
        <h2 class="text-center mb-5 fw-bold">Categorías Destacadas</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card h-100 shadow-sm hover-card">
              <div class="card-body text-center p-4">
                <div class="mb-3">
                  <i class="lni lni-tshirt" style="font-size: 64px; color: #2ECC71;"></i>
                </div>
                <h4 class="card-title">Ropa Deportiva</h4>
                <p class="card-text text-muted">Camisetas, pantalones y más para tu entrenamiento</p>
                <a href="#" class="btn btn-outline-primary">Ver más</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm hover-card">
              <div class="card-body text-center p-4">
                <div class="mb-3">
                  <i class="lni lni-producthunt" style="font-size: 64px; color: #2ECC71;"></i>
                </div>
                <h4 class="card-title">Zapatos Deportivos</h4>
                <p class="card-text text-muted">Las mejores marcas en calzado deportivo</p>
                <a href="#" class="btn btn-outline-primary">Ver más</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm hover-card">
              <div class="card-body text-center p-4">
                <div class="mb-3">
                  <i class="lni lni-briefcase" style="font-size: 64px; color: #2ECC71;"></i>
                </div>
                <h4 class="card-title">Accesorios</h4>
                <p class="card-text text-muted">Complementos para completar tu outfit deportivo</p>
                <a href="#" class="btn btn-outline-primary">Ver más</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Productos Destacados -->
    <section class="py-5 bg-light" id="productos">
      <div class="container">
        <h2 class="text-center mb-5 fw-bold">Productos Destacados</h2>
        <div class="row g-4">
          <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-sm product-card">
              <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 250px; background: #999999;">
                <i class="lni lni-tshirt" style="font-size: 80px; color: white;"></i>
              </div>
              <div class="card-body">
                <span class="badge bg-success mb-2">Nuevo</span>
                <h5 class="card-title">Camiseta Deportiva Pro</h5>
                <p class="card-text text-muted">Tecnología Dri-FIT para máximo rendimiento</p>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="h5 mb-0 text-primary">$29.99</span>
                  <button class="btn btn-primary btn-sm">
                    <i class="lni lni-cart me-1"></i>Agregar
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-sm product-card">
              <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 250px; background: #1A1A1A;">
                <i class="lni lni-producthunt" style="font-size: 80px; color: white;"></i>
              </div>
              <div class="card-body">
                <span class="badge bg-danger mb-2">-20%</span>
                <h5 class="card-title">Zapatos Running Elite</h5>
                <p class="card-text text-muted">Amortiguación superior para corredores</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <span class="h5 mb-0 text-primary">$79.99</span>
                    <small class="text-muted text-decoration-line-through ms-2">$99.99</small>
                  </div>
                  <button class="btn btn-primary btn-sm">
                    <i class="lni lni-cart me-1"></i>Agregar
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-sm product-card">
              <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 250px; background: #2ECC71;">
                <i class="lni lni-tshirt" style="font-size: 80px; color: #1A1A1A;"></i>
              </div>
              <div class="card-body">
                <span class="badge bg-success mb-2">Nuevo</span>
                <h5 class="card-title">Shorts de Entrenamiento</h5>
                <p class="card-text text-muted">Ligeros y transpirables</p>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="h5 mb-0 text-primary">$24.99</span>
                  <button class="btn btn-primary btn-sm">
                    <i class="lni lni-cart me-1"></i>Agregar
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-sm product-card">
              <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 250px; background: #999999;">
                <i class="lni lni-briefcase" style="font-size: 80px; color: white;"></i>
              </div>
              <div class="card-body">
                <h5 class="card-title">Mochila Deportiva</h5>
                <p class="card-text text-muted">Espacio para todo tu equipo</p>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="h5 mb-0 text-primary">$39.99</span>
                  <button class="btn btn-primary btn-sm">
                    <i class="lni lni-cart me-1"></i>Agregar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Ofertas Especiales -->
    <section class="py-5" id="ofertas">
      <div class="container">
        <div class="card bg-primary text-white shadow-lg">
          <div class="card-body p-5 text-center">
            <h2 class="display-5 fw-bold mb-3">¡Ofertas Especiales del Mes!</h2>
            <p class="lead mb-4">Aprovecha hasta 50% de descuento en productos seleccionados</p>
            <a href="#" class="btn btn-light btn-lg">
              <i class="lni lni-offer me-2"></i>Ver Todas las Ofertas
            </a>
          </div>
        </div>
      </div>
    </section>

    <?php MostrarFooter(); ?>

    <?php MostrarJS(); ?>
    <script>
      // Bloquear navegación hacia atrás: al presionar back se queda en home
      history.pushState(null, '', location.href);
      window.addEventListener('popstate', function() {
        history.pushState(null, '', location.href);
      });
    </script>

</body>
</html>
