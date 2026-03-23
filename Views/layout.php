<?php

function MostrarNav(){
    if (session_status() == PHP_SESSION_NONE) session_start();
    $userName = $_SESSION['usuario_nombre'] ?? null;
    $safeName = $userName ? htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') : '';

    // Rutas absolutas para que funcionen desde cualquier ubicación
    $base = '/G4_AmbienteWeb';

    $userMenu = $userName ? <<<HTML
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown">
                <i class="lni lni-user me-1"></i>{$safeName}
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{$base}/Views/Seguridad/cambiarPerfil.php"><i class="lni lni-user me-2"></i>Cambiar Perfil</a></li>
                <li><a class="dropdown-item" href="{$base}/Views/Seguridad/cambiarAcceso.php"><i class="lni lni-lock me-2"></i>Cambiar Contraseña</a></li>
                <li><a class="dropdown-item" href="{$base}/Views/Producto/consultarProductos.php"><i class="lni lni-shopping-basket me-2"></i>Productos</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#" onclick="CerrarSesion(); return false;"><i class="lni lni-exit me-2"></i>Cerrar Sesión</a></li>
              </ul>
            </li>
HTML
    : <<<HTML
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown">
                <i class="lni lni-user me-1"></i>Mi Cuenta
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{$base}/Views/Home/inicio.php"><i class="lni lni-enter me-2"></i>Ingresar</a></li>
                <li><a class="dropdown-item" href="{$base}/Views/Home/registro.php"><i class="lni lni-user-plus me-2"></i>Registrarse</a></li>
              </ul>
            </li>
HTML;

    echo <<<HTML
    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow" style="background-color: #2ECC71;">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{$base}/Views/Home/home.php">
          <i class="lni lni-sport-alt me-2"></i>PowerZone
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link active" href="{$base}/Views/Home/home.php"><i class="lni lni-home me-1"></i>Inicio</a>
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
{$userMenu}
          </ul>
        </div>
      </div>
    </nav>
HTML;
}

function MostrarHeader(){

}

function MostrarFooter(){
echo
'    <footer class="bg-dark text-white py-4">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold text-white"><i class="lni lni-sport-alt me-2"></i>PowerZone</h5>
            <p class="text-white-50">Tu tienda de confianza para equipamiento deportivo de alta calidad.</p>
          </div>
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold text-white">Enlaces Rápidos</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white-50 text-decoration-none">Sobre Nosotros</a></li>
              <li><a href="#" class="text-white-50 text-decoration-none">Política de Envío</a></li>
              <li><a href="#" class="text-white-50 text-decoration-none">Términos y Condiciones</a></li>
            </ul>
          </div>
          <div class="col-md-4 mb-3">
            <h5 class="fw-bold text-white">Contacto</h5>
            <p class="text-white-50 mb-1"><i class="lni lni-phone me-2"></i>+506 1234-5678</p>
            <p class="text-white-50 mb-1"><i class="lni lni-envelope me-2"></i>info@sportzone.com</p>
            <p class="text-white-50"><i class="lni lni-map-marker me-2"></i>San José, Costa Rica</p>
          </div>
        </div>
        <hr class="border-secondary">
        <div class="text-center">
          <p class="mb-0 text-white-50">&copy; 2026 PowerZone. Todos los derechos reservados.</p>
        </div>
      </div>
    </footer>';
}

function MostrarCSS(){
echo
  '<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio | PowerZone - Tienda Deportiva</title>
    <link rel="icon" href="data:,">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/lineicons.css" />
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
  </head>';
}

function MostrarJS(){
echo 
'    <script src="../assets/jss/jquery-3.7.1.min.js"></script>
     <script src="../assets/jss/bootstrap.bundle.min.js"></script>
     <script src="../assets/jss/main.js"></script>
     <script src="../funciones/cerrarSesion.js"></script>';
}