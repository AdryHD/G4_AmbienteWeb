<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro | PowerZone - Tienda Deportiva</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/lineicons.css" />
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
  </head>
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
              <div class="card shadow">
                <div class="card-body p-4">
                  <h4 class="text-center mb-4"><i class="lni lni-user me-2"></i>Registro de Usuario</h4>
                  <form action="procesar_registro.php" method="POST">
                    <div class="mb-3">
                      <label for="nombre" class="form-label">Nombre Completo</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-user"></i></span>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                          placeholder="Juan Pérez" required>
                      </div>
                    </div>
                    
                    <div class="mb-3">
                      <label for="email" class="form-label">Correo Electrónico</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email"
                          placeholder="correo@ejemplo.com" required>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="telefono" class="form-label">Teléfono</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-phone"></i></span>
                        <input type="tel" class="form-control" id="telefono" name="telefono"
                          placeholder="1234-5678" required>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="direccion" class="form-label">Dirección</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-map-marker"></i></span>
                        <input type="text" class="form-control" id="direccion" name="direccion"
                          placeholder="San José, Costa Rica" required>
                      </div>
                    </div>
                    
                    <div class="mb-3">
                      <label for="contrasenna" class="form-label">Contraseña</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-lock"></i></span>
                        <input type="password" class="form-control" id="contrasenna" name="contrasenna"
                          placeholder="Mínimo 6 caracteres" required minlength="6">
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="confirmar_contrasenna" class="form-label">Confirmar Contraseña</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-lock"></i></span>
                        <input type="password" class="form-control" id="confirmar_contrasenna" name="confirmar_contrasenna"
                          placeholder="Repite tu contraseña" required minlength="6">
                      </div>
                    </div>

                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="terminos" required>
                      <label class="form-check-label" for="terminos">
                        Acepto los <a href="#" class="text-primary">términos y condiciones</a>
                      </label>
                    </div>
                    
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary btn-lg">
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

      <footer class="text-center py-3">
        <div class="container">
          <p class="text-muted mb-0">
            &copy; 2026 PowerZone. Todos los derechos reservados.
          </p>
        </div>
      </footer>
    </main>

    <script src="../assets/jss/bootstrap.bundle.min.js"></script>
    <script src="../assets/jss/main.js"></script>
    <script>
      // Validar que las contraseñas coincidan
      document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.getElementById('contrasenna').value;
        const confirmPassword = document.getElementById('confirmar_contrasenna').value;
        
        if (password !== confirmPassword) {
          e.preventDefault();
          alert('Las contraseñas no coinciden. Por favor, verifica.');
          return false;
        }
      });
    </script>
  </body>
</html>
