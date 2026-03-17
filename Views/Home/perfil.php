<?php
// Página de perfil protegida
if (session_status() == PHP_SESSION_NONE) session_start();

if (empty($_SESSION['usuario_logueado'])) {
    header('Location: /G4_AmbienteWeb/Views/Home/inicio.php');
    exit;
}

$nombre = htmlspecialchars($_SESSION['usuario_nombre'] ?? '');
$correo = htmlspecialchars($_SESSION['usuario_email'] ?? '');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mi Perfil - PowerZone</title>
  <link rel="stylesheet" href="/G4_AmbienteWeb/Views/assets/css/bootstrap.min.css" />
</head>
<body class="bg-light">
  <main class="container py-5">
    <div class="card mx-auto" style="max-width:600px;">
      <div class="card-body">
        <h3 class="card-title">Mi Perfil</h3>
        <p class="mb-1"><strong>Nombre:</strong> <?php echo $nombre; ?></p>
        <p class="mb-1"><strong>Correo:</strong> <?php echo $correo; ?></p>
        <div class="mt-3">
          <a href="/G4_AmbienteWeb/Views/Home/logout.php" class="btn btn-danger">Cerrar Sesión</a>
          <a href="/G4_AmbienteWeb/Views/Home/home.php" class="btn btn-secondary ms-2">Volver</a>
        </div>
      </div>
    </div>
  </main>

  <script src="/G4_AmbienteWeb/Views/assets/jss/bootstrap.bundle.min.js"></script>
</body>
</html>
