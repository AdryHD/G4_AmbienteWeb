<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio | PowerZone - Tienda Deportiva</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/lineicons.css" />
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow" style="background-color: #2ECC71;">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="home.php">
          <i class="lni lni-sport-alt me-2"></i>PowerZone
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link active" href="home.php"><i class="lni lni-home me-1"></i>Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#productos"><i class="lni lni-shopping-basket me-1"></i>Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#ofertas"><i class="lni lni-offer me-1"></i>Ofertas</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="lni lni-cart me-1"></i>Carrito <span class="badge bg-danger">0</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown">
                <i class="lni lni-user me-1"></i>Mi Cuenta
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="lni lni-user me-2"></i>Perfil</a></li>
                <li><a class="dropdown-item" href="#"><i class="lni lni-package me-2"></i>Mis Pedidos</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="inicio.php"><i class="lni lni-exit me-2"></i>Cerrar Sesión</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

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

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold"><i class="lni lni-sport-alt me-2"></i>PowerZone</h5>
            <p class="text-muted">Tu tienda de confianza para equipamiento deportivo de alta calidad.</p>
          </div>
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Enlaces Rápidos</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-muted text-decoration-none">Sobre Nosotros</a></li>
              <li><a href="#" class="text-muted text-decoration-none">Política de Envío</a></li>
              <li><a href="#" class="text-muted text-decoration-none">Términos y Condiciones</a></li>
            </ul>
          </div>
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold">Contacto</h5>
            <p class="text-muted mb-1"><i class="lni lni-phone me-2"></i>+506 1234-5678</p>
            <p class="text-muted mb-1"><i class="lni lni-envelope me-2"></i>info@sportzone.com</p>
            <p class="text-muted"><i class="lni lni-map-marker me-2"></i>San José, Costa Rica</p>
          </div>
        </div>
        <hr class="border-secondary">
        <div class="text-center">
          <p class="mb-0 text-muted">&copy; 2026 PowerZone. Todos los derechos reservados.</p>
        </div>
      </div>
    </footer>

    <script src="../assets/jss/bootstrap.bundle.min.js"></script>
    <script src="../assets/jss/main.js"></script>
  </body>
</html>
