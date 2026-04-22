<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Views/layoutExterno.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Controllers/HomeController.php";
?>

<!DOCTYPE html>
<html lang="es">

<?php MostrarCSS(); ?>

<body>

    <main class="main-wrapper" style="margin-left:0;">

        <?php MostrarHeader(); ?>

        <!-- Banner de recuperación -->
        <div style="background: linear-gradient(135deg, #2ECC71 0%, #1A8A4A 100%); padding: 40px 0 60px;">
            <div class="container text-center text-white">
                <div class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:80px;height:80px;">
                    <i class="lni lni-envelope" style="font-size:40px;color:#2ECC71;"></i>
                </div>
                <h3 class="fw-bold mb-1">Recuperar Acceso</h3>
                <p class="mb-0" style="opacity:.85;">Te enviaremos una contraseña temporal a tu correo</p>
            </div>
        </div>

        <section class="section" style="margin-top:-30px; padding-bottom: 60px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-5">

                        <?php
                        if (isset($_POST["Mensaje"])) {
                            $tipoAlerta = $_POST["TipoMensaje"] ?? 'danger';
                            $icono = $tipoAlerta === 'success' ? 'lni-checkmark-circle' : 'lni-warning';
                            echo '<div class="alert alert-' . $tipoAlerta . ' d-flex align-items-center gap-2" role="alert">'
                                . '<i class="lni ' . $icono . '"></i>'
                                . '<span>' . htmlspecialchars($_POST["Mensaje"], ENT_QUOTES, 'UTF-8') . '</span>'
                                . '</div>';
                        }
                        ?>

                        <div class="card shadow border-0">
                            <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
                                <h5 class="mb-0 fw-bold"><i class="lni lni-envelope me-2" style="color:#2ECC71;"></i>Ingresa tu correo</h5>
                                <small class="text-muted">Recibirás una contraseña temporal para acceder.</small>
                            </div>
                            <div class="card-body p-4">
                                <form id="formRecuperarAcceso" action="" method="POST" novalidate>

                                    <div class="mb-4">
                                        <label for="CorreoElectronico" class="form-label fw-semibold">Correo Electrónico</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="lni lni-envelope"></i></span>
                                            <input type="email" class="form-control" id="CorreoElectronico"
                                                name="CorreoElectronico" placeholder="correo@ejemplo.com" required />
                                            <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" id="btnRecuperarAcceso" name="btnRecuperarAcceso"
                                            class="btn btn-lg text-white fw-semibold"
                                            style="background:#2ECC71; border:none;">
                                            <i class="lni lni-envelope me-2"></i>Enviar Correo
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <a href="inicio.php" class="text-decoration-none" style="color:#2ECC71;">
                                <i class="lni lni-arrow-left me-1"></i>Volver al inicio de sesión
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <?php MostrarFooter(); ?>

    </main>

    <?php MostrarJS(); ?>
    <script src="../funciones/recuperarAcceso.js"></script>

</body>

</html>

                            <div class="row g-0 auth-row">
                                <div class="col-lg-6">
                                    <div class="auth-cover-wrapper bg-primary-100">
                                        <div class="auth-cover">
                                            <div class="title text-center">
                                                <h1 class="text-primary mb-10">Bienvenid@</h1>
                                                <p class="text-medium">
                                                    Enviaremos un correo electrónico
                                                </p>
                                            </div>
                                            <div class="cover-image">
                                                <img src="../assets/images/signup-image.svg" alt="" />
                                            </div>
                                            <div class="shape-image">
                                                <img src="../assets/images/shape.svg" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="signup-wrapper">
                                        <div class="form-wrapper">

                                            <?php
                                            if (isset($_POST["Mensaje"])) {
                                                echo '<div class="alert alert-danger text-center" role="alert">'
                                                    . htmlspecialchars($_POST["Mensaje"]) . '</div>';
                                            }
                                            ?>

                                            <h3 class="mb-15">Recuperar Acceso</h3>

                                            <form id="formRecuperarAcceso" action="" method="POST">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-style-1">
                                                            <label>Correo Electrónico</label>
                                                            <input type="text" placeholder="Correo Electrónico"
                                                                id="CorreoElectronico" name="CorreoElectronico" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="button-group d-flex justify-content-center flex-wrap">
                                                            <button type="submit" id="btnRecuperarAcceso" name="btnRecuperarAcceso"
                                                                class="main-btn primary-btn btn-hover w-100 text-center">
                                                                Procesar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <div class="singup-option pt-40">
                                                <p class="text-sm text-medium text-dark text-center">
                                                    Ya tiene una cuenta? <a href="inicio.php">Inicia Sesión</a>
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
    <script src="../funciones/recuperarAcceso.js"></script>

</body>

</html>
