<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blank Page | PlainAdmin Demo</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/lineicons.css" />
    <link rel="stylesheet" href="../assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
  </head>
  <body>
    <aside class="sidebar-nav-wrapper">
      <div class="navbar-logo">
        <a href="index.html">
          <img src="../assets/images/logo.svg" alt="logo" />
        </a>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item">
            <a href="notification.html">
              <span class="icon"></span>
              <span class="text">Notifications</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <div class="overlay"></div>
    <main class="main-wrapper">
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-15">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">             
                <div class="profile-box ml-15">
                  <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-info">
                      <div class="info">
                        <div class="image">
                          <img src="../assets/images/profile-image.png" alt="" />
                        </div>
                        <div>
                          <h6 class="fw-500">Adam Joe</h6>
                          <p>Admin</p>
                        </div>
                      </div>
                    </div>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                    <li>
                      <div class="author-info flex items-center !p-1">
                        <div class="image">
                          <img src="../assets/images/profile-image.png" alt="image">
                        </div>
                        <div class="content">
                          <h4 class="text-sm">Adam Joe</h4>
                          <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                            href="#">Email@gmail.com</a>
                        </div>
                      </div>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#0"><i class="lni lni-user"></i> View Profile</a></li>                    
                    <li><a href="#0"><i class="lni lni-cog"></i> Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="#0"><i class="lni lni-exit"></i> Sign Out</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <section class="section">
        <div class="container-fluid">
          <div class="row justify-content-center pt-50">
            <div class="col-md-5">
              <div class="card shadow-sm">
                <div class="card-body">
                  <h4 class="text-center mb-4">Inicio de Sesión</h4>
                  <form action="procesar_login.php" method="POST">
                    <div class="mb-3">
                      <label for="identificacion" class="form-label">Identificación</label>
                      <input type="text" class="form-control" id="identificacion" name="identificacion"
                        placeholder="Ingrese su identificación" required>
                    </div>
                    <div class="mb-3">
                      <label for="contrasenna" class="form-label">Contraseña</label>
                      <input type="password" class="form-control" id="contrasenna" name="contrasenna"
                        placeholder="Ingrese su contraseña" required>
                    </div>
                    <div class="d-grid">
                      <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 order-last order-md-first">
              <div class="copyright text-center text-md-start">
                <p class="text-sm">
                  Designed and Developed by
                  <a href="https://plainadmin.com" rel="nofollow" target="_blank">PlainAdmin</a>
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="terms d-flex justify-content-center justify-content-md-end">
                <a href="#0" class="text-sm">Term & Conditions</a>
                <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </main>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/Chart.min.js"></script>
    <script src="../assets/js/dynamic-pie-chart.js"></script>
    <script src="../assets/js/moment.min.js"></script>
    <script src="../assets/js/fullcalendar.js"></script>
    <script src="../assets/js/jvectormap.min.js"></script>
    <script src="../assets/js/world-merc.js"></script>
    <script src="../assets/js/polyfill.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>
