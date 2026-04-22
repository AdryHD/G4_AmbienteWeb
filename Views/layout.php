<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['usuario_logueado'])) {
    require_once __DIR__ . "/../bootstrap.php";
    header('Location: ' . APP_BASE_URL . '/Views/Home/inicio.php?error=must_login');
    exit;
}

require_once __DIR__ . "/../bootstrap.php";
include_once APP_FS_ROOT . "/Models/CarritoModel.php";
include_once APP_FS_ROOT . "/Views/Seguridad/role_guard.php";

function obtenerColorEstado($estado) {
    $estado = strtolower(trim($estado));
    switch ($estado) {
        case 'pendiente': return 'bg-warning text-dark';
        case 'empacado':  return 'bg-info text-white';
        case 'enviado':   return 'bg-primary text-white';
        case 'entregado': return 'bg-success text-white';
        case 'cancelado': return 'bg-danger text-white';
        default:          return 'bg-secondary text-white';
    }
}

function MostrarNav(){
    if (session_status() == PHP_SESSION_NONE) session_start();
    $userName    = $_SESSION['usuario_nombre']     ?? null;
    $nombreRol   = $_SESSION['usuario_nombre_rol'] ?? '';
    $safeName    = $userName  ? htmlspecialchars($userName,  ENT_QUOTES, 'UTF-8') : '';
    $safeRol     = $nombreRol ? htmlspecialchars($nombreRol, ENT_QUOTES, 'UTF-8') : '';

    $base = APP_BASE_URL;

    $esAdmin = isAdmin();
    $gestionProductos = $esAdmin
        ? "<li><a class=\"dropdown-item\" href=\"{$base}/Views/Producto/consultarProductos.php\"><i class=\"lni lni-shopping-basket me-2\"></i>Gestión Productos</a></li>"
        : '';

    $gestionUsuarios = $esAdmin
        ? "<li><a class=\"dropdown-item\" href=\"{$base}/Views/Seguridad/gestionarUsuarios.php\"><i class=\"lni lni-users me-2\"></i>Gestión Usuarios</a></li>"
        : '';

    $userMenu = $userName ? <<<HTML
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" style="color: white; font-weight: 600; line-height: 1.2;">
                <i class="lni lni-user me-1"></i>{$safeName}<br>
                <small style="font-size:0.7rem; font-weight:400; opacity:0.85;">{$safeRol}</small>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 10px; border: 2px solid #2ECC71; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); margin-top: 10px;">
                <li><a class="dropdown-item" href="{$base}/Views/Seguridad/cambiarPerfil.php"><i class="lni lni-user me-2"></i>Cambiar Perfil</a></li>
                <li><a class="dropdown-item" href="{$base}/Views/Seguridad/cambiarAcceso.php"><i class="lni lni-lock me-2"></i>Cambiar Contraseña</a></li>
                {$gestionUsuarios}
                {$gestionProductos}
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#" onclick="CerrarSesion(); return false;"><i class="lni lni-exit me-2"></i>Cerrar Sesión</a></li>
              </ul>
            </li>
HTML
    : <<<HTML
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" style="color: white; font-weight: 600;">
                <i class="lni lni-user me-1"></i>Mi Cuenta
              </a>
              <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 10px; border: 2px solid #2ECC71; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); margin-top: 10px;">
                <li><a class="dropdown-item" href="{$base}/Views/Home/inicio.php"><i class="lni lni-enter me-2"></i>Ingresar</a></li>
                <li><a class="dropdown-item" href="{$base}/Views/Home/registro.php"><i class="lni lni-user-plus me-2"></i>Registrarse</a></li>
              </ul>
            </li>
HTML;


    $cartCount = 0;
    $userId = $_SESSION['usuario_id'] ?? null;
    if ($userId && !$esAdmin) {
      $items = ObtenerCarritoModel($userId);
      if (is_array($items)) {
        foreach ($items as $it) {
          $cartCount += isset($it['cantidad']) ? (int)$it['cantidad'] : 0;
        }
      }
    }

    $navLinks = $esAdmin
        ? <<<HTML
            <li class="nav-item">
              <a class="nav-link" href="{$base}/Views/Home/home.php" style="color: white; font-weight: 600;">
                <i class="lni lni-home me-1"></i>Inicio
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{$base}/Views/Producto/consultarPedido.php" style="color: white; font-weight: 600;">
                <i class="lni lni-package me-1"></i>Pedidos
              </a>
            </li>
HTML
        : <<<HTML
            <li class="nav-item">
              <a class="nav-link" href="{$base}/Views/Home/home.php" style="color: white; font-weight: 600;">
                <i class="lni lni-home me-1"></i>Inicio
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{$base}/Views/Producto/tienda.php" style="color: white; font-weight: 600;">
                <i class="lni lni-shopping-basket me-1"></i>Productos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{$base}/Views/Producto/tienda.php?cat=99" style="color: white; font-weight: 600;">
                <i class="lni lni-offer me-1"></i>Ofertas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{$base}/Views/Producto/HistorialCompras.php" style="color: white; font-weight: 600;">
                <i class="lni lni-package me-1"></i>Pedidos
              </a>
            </li>
HTML;

    $cartLink = $esAdmin ? '' : <<<HTML
            <li class="nav-item">
              <a class="nav-link" href="{$base}/Views/Producto/carrito.php" style="color: white; font-weight: 600;">
                <i class="lni lni-cart me-1"></i>Carrito <span id="cart-badge" class="badge bg-danger" style="font-size: 0.7rem; padding: 3px 6px;">{$cartCount}</span>
              </a>
            </li>
HTML;

    echo <<<HTML
    <nav class="navbar navbar-expand-lg sticky-top shadow" style="background: linear-gradient(135deg, #2ECC71 0%, #27a654 100%);">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{$base}/Views/Home/home.php" style="color: white; font-size: 1.4rem; letter-spacing: -0.5px; display: flex; align-items: center; gap: 10px;">
          <img src="{$base}/Views/assets/images/00logo.png" alt="PowerZone Logo" style="height: 45px; width: auto; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
          <span style="display: inline-block;">PowerZone</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: rgba(255,255,255,0.5);">
          <span class="navbar-toggler-icon" style="background-image: url(\"data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e\");"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto">
{$navLinks}
          </ul>
          <ul class="navbar-nav">
{$cartLink}
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
    echo <<<'HTML'
    <footer style="background: linear-gradient(135deg, #1A1A1A 0%, #000000 100%); color: white; padding: 4rem 0 1rem 0; margin-top: 3rem; border-top: 3px solid #2ECC71;">
      <div class="container">
        <div class="row" style="margin-bottom: 2rem;">
          <div class="col-md-4 mb-4">
            <h5 class="fw-bold text-white mb-3" style="font-size: 1.3rem;"><i class="lni lni-sport-alt me-2"></i>PowerZone</h5>
            <p style="color: rgba(255, 255, 255, 0.7); line-height: 1.8;">Tu tienda de confianza para equipamiento deportivo de alta calidad. Calidad garantizada desde 2026.</p>
            <div style="margin-top: 15px;">
              <a href="#" style="color: #2ECC71; font-size: 1.2rem; margin-right: 12px;"><i class="lni lni-facebook-fill"></i></a>
              <a href="#" style="color: #2ECC71; font-size: 1.2rem; margin-right: 12px;"><i class="lni lni-twitter-original"></i></a>
              <a href="#" style="color: #2ECC71; font-size: 1.2rem; margin-right: 12px;"><i class="lni lni-instagram"></i></a>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <h5 class="fw-bold text-white mb-3">Enlaces Rápidos</h5>
            <ul class="list-unstyled">
              <li><a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s;"><i class="lni lni-chevron-right me-2"></i>Sobre Nosotros</a></li>
              <li><a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s;"><i class="lni lni-chevron-right me-2"></i>Política de Envío</a></li>
              <li><a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s;"><i class="lni lni-chevron-right me-2"></i>Términos y Condiciones</a></li>
              <li><a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: all 0.3s;"><i class="lni lni-chevron-right me-2"></i>Política de Privacidad</a></li>
            </ul>
          </div>
          <div class="col-md-4 mb-4">
            <h5 class="fw-bold text-white mb-3">Contacto</h5>
            <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 12px;"><i class="lni lni-phone me-2" style="color: #2ECC71;"></i>+506 1234-5678</p>
            <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 12px;"><i class="lni lni-envelope me-2" style="color: #2ECC71;"></i>info@powerzone.com</p>
            <p style="color: rgba(255, 255, 255, 0.7);"><i class="lni lni-map-marker me-2" style="color: #2ECC71;"></i>San José, Costa Rica</p>
          </div>
        </div>
        <hr style="border-color: rgba(255, 255, 255, 0.1); margin: 2rem 0;">
        <div class="row align-items-center">
          <div class="col-md-6">
            <p class="mb-0" style="color: rgba(255, 255, 255, 0.6);">&copy; 2026 PowerZone. Todos los derechos reservados.</p>
          </div>
          <div class="col-md-6 text-md-end">
            <p class="mb-0" style="color: rgba(255, 255, 255, 0.6);">Diseñado con <i class="lni lni-heart" style="color: #2ECC71;"></i> para tu experiencia</p>
          </div>
        </div>
      </div>
    </footer>
HTML;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.css" />
  </head>';
}

function MostrarJS(){
    $base = htmlspecialchars(APP_BASE_URL, ENT_QUOTES, 'UTF-8');
    echo <<<HTML
    <script>window.APP_BASE_URL = "{$base}";</script>
    <script src="../assets/jss/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="../assets/jss/bootstrap.bundle.min.js"></script>
    <script src="../assets/jss/main.js"></script>
    <script src="../funciones/cerrarSesion.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.js"></script>

    <style>
      #app-toast{position:fixed;right:20px;top:20px;z-index:1100;min-width:260px;max-width:360px}
      #app-toast .toast-box{background:#111;color:#fff;padding:12px 16px;border-radius:10px;box-shadow:0 8px 20px rgba(0,0,0,0.2);display:flex;gap:12px;align-items:center}
      #app-toast .toast-box.success{background:linear-gradient(135deg,#27a654,#1a7a3f)}
      #app-toast .toast-box.danger{background:linear-gradient(135deg,#d9534f,#c0392b)}
    </style>

    <div id="app-toast" aria-live="polite" aria-atomic="true" style="display:none;"></div>

    <script>
      function showToast(message, type = 'success', timeout = 800){
        try {
          const container = document.getElementById('app-toast');
          if (!container) return;
          container.style.display = 'block';
          const box = document.createElement('div');
          box.className = 'toast-box ' + (type === 'danger' ? 'danger' : 'success');
          box.innerHTML = '<div style="flex:1">' + (message || '') + '</div>' + '<div style="cursor:pointer;margin-left:8px;opacity:.9" onclick="this.parentNode.remove();">&times;</div>';
          container.appendChild(box);
          setTimeout(() => { try{ box.remove(); if (container.children.length === 0) container.style.display = 'none'; }catch(e){} }, timeout);
        } catch(e){}
      }
    </script>
HTML;
}