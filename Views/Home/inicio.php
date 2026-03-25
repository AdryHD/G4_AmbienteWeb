<?php
// Al llegar al login siempre se cierra la sesión activa,
// pero se preservan los mensajes flash del controlador.
if (session_status() == PHP_SESSION_NONE) session_start();
$_flashMsg  = $_SESSION['mensaje']      ?? '';
$_flashType = $_SESSION['tipo_mensaje'] ?? 'info';
session_unset();
session_destroy();
session_start();
if ($_flashMsg) {
    $_SESSION['mensaje']      = $_flashMsg;
    $_SESSION['tipo_mensaje'] = $_flashType;
}
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/HomeController.php";
?>
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
                    <?php
                    // Mostrar mensajes de error/éxito desde $_SESSION
                    if (session_status() == PHP_SESSION_NONE) session_start();
                    if (!empty($_SESSION['mensaje'])) {
                      $msg = $_SESSION['mensaje'];
                      $type = $_SESSION['tipo_mensaje'] ?? 'info';
                      echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">' . htmlspecialchars($msg) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                      unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);
                    }
                    // También mostrar mensajes por GET (compatibilidad)
                    $error = $_GET['error'] ?? '';
                    if ($error) {
                      $msg = '';
                      $type = 'danger';
                      switch ($error) {
                        case 'campos_vacios':
                          $msg = 'Por favor complete todos los campos.';
                          break;
                        case 'credenciales_invalidas':
                          $msg = 'Correo o contraseña incorrectos.';
                          break;
                        case 'no_encontrado':
                          $msg = 'Usuario no encontrado.';
                          $type = 'warning';
                          break;
                        case 'must_login':
                          $msg = 'Debes iniciar sesión para acceder a esa página.';
                          $type = 'info';
                          break;
                        case 'error_servidor':
                          $msg = 'Error del servidor. Inténtalo más tarde.';
                          break;
                        default:
                          $msg = 'Ocurrió un error. Inténtalo de nuevo.';
                      }
                      echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">' . htmlspecialchars($msg) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    }
                    ?>
                  <?php if (isset($_POST["Mensaje"])): ?>
                    <div class="alert alert-<?php echo htmlspecialchars($_POST["TipoMensaje"] ?? 'danger'); ?> alert-dismissible fade show" role="alert">
                      <?php echo htmlspecialchars($_POST["Mensaje"]); ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php endif; ?>
                  <form id="formLogin" action="" method="POST" novalidate>
                    <div class="mb-3">
                      <label for="CorreoElectronico" class="form-label">Correo Electrónico</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-envelope"></i></span>
                        <input type="email" class="form-control" id="CorreoElectronico" name="CorreoElectronico"
                          placeholder="correo@ejemplo.com" required>
                      </div>
                      <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
                    </div>
                    <div class="mb-3">
                      <label for="Contrasenna" class="form-label">Contraseña</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="lni lni-lock"></i></span>
                        <input type="password" class="form-control" id="Contrasenna" name="Contrasenna"
                          placeholder="Ingrese su contraseña" required>
                      </div>
                      <div class="invalid-feedback">Campo obligatorio.</div>
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="recordar">
                      <label class="form-check-label" for="recordar">Recordar sesión</label>
                    </div>
                    <div class="d-grid">
                      <button type="submit" name="btnIniciarSesion" class="btn btn-success btn-lg" style="background:#2ecc71;border:none;"><i class="lni lni-enter me-2"></i>Ingresar</button>
                    </div>
                  </form>
                  <div class="text-center mt-3">
                    <p class="mb-1">¿No tienes cuenta? <a href="registro.php" class="text-primary fw-bold">Regístrate aquí</a></p>
                    <p class="mb-0"><a href="recuperarAcceso.php" class="text-muted small">¿Olvidaste tu contraseña?</a></p>
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

    <script src="../assets/jss/jquery-3.7.1.min.js"></script>
    <script src="../assets/jss/bootstrap.bundle.min.js"></script>
    <script src="../assets/jss/main.js"></script>
    <script src="../funciones/login.js"></script>
  </body>
</html>

                            <div class="row g-0 auth-row">
                                <div class="col-lg-6">
                                    <div class="auth-cover-wrapper bg-primary-100">
                                        <div class="auth-cover">
                                            <div class="title text-center">
                                                <h1 class="text-primary mb-10">Bienvenid@</h1>
                                                <p class="text-medium">
                                                    Inicia sesión para continuar
                                                </p>
                                            </div>
                                            <div class="cover-image">
                                                <img src="../assets/images/signin-image.svg" alt="" />
                                            </div>
                                            <div class="shape-image">
                                                <img src="../assets/images/shape.svg" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="signin-wrapper">
                                        <div class="form-wrapper">

                                            <?php
                                            if (!empty($_SESSION['mensaje'])) {
                                                $tipo = $_SESSION['tipo_mensaje'] ?? 'info';
                                                echo '<div class="alert alert-' . $tipo . ' text-center" role="alert">'
                                                    . htmlspecialchars($_SESSION['mensaje']) . '</div>';
                                                unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);
                                            }
                                            if (isset($_POST["Mensaje"])) {
                                                echo '<div class="alert alert-danger text-center" role="alert">'
                                                    . htmlspecialchars($_POST["Mensaje"]) . '</div>';
                                            }
                                            ?>

                                            <h3 class="mb-15">Iniciar Sesión</h3>

                                            <form id="formLogin" action="" method="POST">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-style-1">
                                                            <label>Correo Electrónico</label>
                                                            <input type="text" placeholder="Correo Electrónico"
                                                                id="CorreoElectronico" name="CorreoElectronico" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-style-1">
                                                            <label>Contraseña</label>
                                                            <input type="password" placeholder="Contraseña"
                                                                id="Contrasenna" name="Contrasenna" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-12 col-lg-12 col-md-12">
                                                        <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                                            <a href="recuperarAcceso.php" class="hover-underline">
                                                                Olvidó su contraseña?
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="button-group d-flex justify-content-center flex-wrap">
                                                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center"
                                                                id="btnIniciarSesion" name="btnIniciarSesion">
                                                                Procesar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="singin-option pt-40">
                                                <p class="text-sm text-medium text-dark text-center">
                                                    No tiene una cuenta aún?
                                                    <a href="registro.php">Registrarse</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php MostrarFooter(); ?>

    </main>

    <?php MostrarJS(); ?>
    <script src="../funciones/login.js"></script>

</body>

</html>
