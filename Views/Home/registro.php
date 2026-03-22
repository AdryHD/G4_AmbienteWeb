<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AMBIENTEWEB/Views/layoutExterno.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AMBIENTEWEB/Controllers/Controller.php";
?>

<!DOCTYPE html>
<html lang="es">

<?php
MostrarCSS();
?>
<body>
    <div id="preloader">
        <div class="spinner"></div>
    </div>

  <body class="bg-light">
  <main class="main-wrapper" style="margin-left: 0;">
    <section class="section min-vh-100 d-flex align-items-center py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-5">
            <div class="text-center mb-4">
              <h1 class="display-5 fw-bold text-primary">PowerZone</h1>
              <p class="text-muted">Crea tu cuenta y comienza a comprar</p>
            </div>

            <?php if (isset($_POST["Mensaje"])): ?>
              <div class="alert alert-<?php echo $_POST["TipoMensaje"]; ?> text-center">
                <?php echo htmlspecialchars($_POST["Mensaje"]); ?>
              </div>
            <?php endif; ?>

            <div class="card shadow">
              <div class="card-body p-4">
                <h4 class="text-center mb-4"><i class="lni lni-user me-2"></i>Registro de Usuario</h4>

                <form id="formRegistro" action="../../Controllers/HomeController.php" method="POST" novalidate>
                  <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="lni lni-user"></i></span>
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Juan Pérez" required>
                    </div>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                  </div>

                  <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="lni lni-envelope"></i></span>
                      <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@ejemplo.com" required>
                    </div>
                    <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
                  </div>

                  <div class="mb-3">
                    <label for="contrasenna" class="form-label">Contraseña</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="lni lni-lock"></i></span>
                      <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Mínimo 6 caracteres" required minlength="6">
                    </div>
                    <div class="invalid-feedback">Mínimo 6 caracteres.</div>
                  </div>

                  <div class="mb-3">
                    <label for="confirmar_contrasenna" class="form-label">Confirmar Contraseña</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="lni lni-lock"></i></span>
                      <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Repite tu contraseña" required minlength="6">
                    </div>
                    <div class="invalid-feedback" id="error-confirmar">Las contraseñas no coinciden.</div>
                  </div>

                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terminos" required>
                    <label class="form-check-label" for="terminos">
                      Acepto los <a href="#" class="text-primary">términos y condiciones</a>
                    </label>
                    <div class="invalid-feedback">Debes aceptar los términos.</div>
                  </div>

                  <div class="d-grid">
                    <button type="submit" name="btnRegistrar" class="btn btn-primary btn-lg">
                      <i class="lni lni-checkmark me-2"></i>Registrarse
                    </button>
                  </div>
                </form>

                <div class="text-center mt-3">
                  <p class="mb-0">¿Ya tienes cuenta? <a href="inicio.php" class="text-primary fw-bold">Inicia sesión aquí</a></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

   <?php
   MostrarFooter();
   ?>
    
  <?php
   MostrarJS();
   ?>
   <script src="../funciones/registro.js"></script>
  </body>
</html>
