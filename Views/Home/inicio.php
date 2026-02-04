<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión | PowerZone - Tienda Deportiva</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/lineicons.css" />
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../assets/css/custom.css" />
  </head>
  <body class="bg-light">
    <main class="main-wrapper" style="margin-left: 0;">
      <section class="section min-vh-100 d-flex align-items-center">
        <div class="container-fluid">
          <div class="row justify-content-center pt-50">
            <div class="col-md-5">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h4 class="text-center mb-4">Inicio de Sesión</h4>
                  <form action="procesar_login.php" method="POST">
                    <div class="mb-3">
                      <label for="email" class="form-label">Correo Electrónico</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email"
                          placeholder="correo@ejemplo.com" required>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="contrasenna" class="form-label">Contraseña</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-lock"></i></span>
                        <input type="password" class="form-control" id="contrasenna" name="contrasenna"
                          placeholder="Ingrese su contraseña" required>
                      </div>
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="recordar">
                      <label class="form-check-label" for="recordar">Recordar sesión</label>
                    </div>
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary btn-lg"><i class="lni lni-enter me-2"></i>Ingresar</button>
                    </div>
                  </form>
                  <div class="text-center mt-3">
                    <p class="mb-0">¿No tienes cuenta? <a href="registro.php" class="text-primary fw-bold">Regístrate aquí</a></p>
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
  </body>
</html>
