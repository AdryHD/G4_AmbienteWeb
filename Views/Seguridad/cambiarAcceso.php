<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb-main/Controllers/SeguridadController.php";
?>

<!DOCTYPE html>
<html lang="es">

<?php MostrarCSS(); ?>

<body>

    <?php MostrarNav(); ?>

    <main class="main-wrapper" style="margin-left:0;">

        <!-- Banner de seguridad -->
        <div style="background: linear-gradient(135deg, #2ECC71 0%, #1A8A4A 100%); padding: 40px 0 60px;">
            <div class="container text-center text-white">
                <div class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:80px;height:80px;">
                    <i class="lni lni-lock" style="font-size:40px;color:#2ECC71;"></i>
                </div>
                <h3 class="fw-bold mb-1">Seguridad de Cuenta</h3>
                <p class="mb-0" style="opacity:.85;">Actualiza tu contraseña de acceso</p>
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
                                <h5 class="mb-0 fw-bold"><i class="lni lni-lock me-2" style="color:#2ECC71;"></i>Cambiar Contraseña</h5>
                                <small class="text-muted">Elige una contraseña segura de al menos 6 caracteres.</small>
                            </div>
                            <div class="card-body p-4">
                                <form id="formCambiarAcceso" action="" method="POST" novalidate>

                                    <div class="mb-3">
                                        <label for="NuevaContrasena" class="form-label fw-semibold">Nueva Contraseña</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="lni lni-lock"></i></span>
                                            <input type="password" class="form-control" id="NuevaContrasena"
                                                name="NuevaContrasena" placeholder="Mínimo 6 caracteres"
                                                required minlength="6" />
                                            <div class="invalid-feedback">Ingrese una contraseña de al menos 6 caracteres.</div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="ConfirmarContrasena" class="form-label fw-semibold">Confirmar Contraseña</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="lni lni-lock"></i></span>
                                            <input type="password" class="form-control" id="ConfirmarContrasena"
                                                name="ConfirmarContrasena" placeholder="Repite tu nueva contraseña"
                                                required minlength="6" />
                                            <div class="invalid-feedback">Las contraseñas no coinciden.</div>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" id="btnCambiarAcceso" name="btnCambiarAcceso"
                                                class="btn btn-lg text-white fw-semibold"
                                                style="background:#2ECC71; border:none;">
                                            <i class="lni lni-checkmark me-2"></i>Guardar Contraseña
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <a href="/G4_AmbienteWeb-main/Views/Seguridad/cambiarPerfil.php" class="text-decoration-none" style="color:#2ECC71;">
                                <i class="lni lni-arrow-left me-1"></i>Volver a mi perfil
                            </a>
                        </div>

<?php MostrarJS(); ?>
<script src="../funciones/cambiarAcceso.js"></script>
</html>
