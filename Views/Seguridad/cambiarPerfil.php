<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Controllers/SeguridadController.php";

$datosUsuario = ConsultarUsuario();
?>

<!DOCTYPE html>
<html lang="es">

<?php MostrarCSS(); ?>

<body>

    <?php MostrarNav(); ?>

    <main class="main-wrapper" style="margin-left:0;">

        <!-- Banner de perfil -->
        <div style="background: linear-gradient(135deg, #2ECC71 0%, #1A8A4A 100%); padding: 40px 0 60px;">
            <div class="container text-center text-white">
                <div class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:80px;height:80px;">
                    <i class="lni lni-user" style="font-size:40px;color:#2ECC71;"></i>
                </div>
                <h3 class="fw-bold mb-1"><?php echo htmlspecialchars($datosUsuario['nombre'] ?? 'Usuario', ENT_QUOTES, 'UTF-8'); ?></h3>
                <p class="mb-0" style="opacity:.85;"><?php echo htmlspecialchars($datosUsuario['correo'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
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
                            if ($tipoAlerta === 'success') {
                                echo '<div class="d-grid mb-3">'
                                    . '<a href="/G4_AmbienteWeb/Views/Home/home.php" class="btn btn-lg text-white fw-semibold" style="background:#1A8A4A;border:none;">'
                                    . '<i class="lni lni-home me-2"></i>Ir a Inicio'
                                    . '</a></div>';
                            }
                        }
                        ?>

                        <div class="card shadow border-0">
                            <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
                                <h5 class="mb-0 fw-bold"><i class="lni lni-pencil-alt me-2" style="color:#2ECC71;"></i>Editar Información</h5>
                                <small class="text-muted">Los cambios se guardarán inmediatamente.</small>
                            </div>
                            <div class="card-body p-4">
                                <form id="formCambiarPerfil" action="" method="POST" novalidate>

                                    <div class="mb-3">
                                        <label for="Cedula" class="form-label fw-semibold">Cédula</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="lni lni-id-card"></i></span>
                                            <input type="text" class="form-control" id="Cedula" name="Cedula"
                                                placeholder="Ej: 1-1234-5678"
                                                value="<?php echo htmlspecialchars($datosUsuario['cedula'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                                required oninput="ConsultarNombre()" />
                                            <div class="invalid-feedback">La cédula es obligatoria.</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="Nombre" class="form-label fw-semibold">Nombre completo</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="lni lni-user"></i></span>
                                            <input type="text" class="form-control" id="Nombre" name="Nombre"
                                                placeholder="Tu nombre completo"
                                                value="<?php echo htmlspecialchars($datosUsuario['nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                                required />
                                            <div class="invalid-feedback">El nombre es obligatorio.</div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="CorreoElectronico" class="form-label fw-semibold">Correo Electrónico</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="lni lni-envelope"></i></span>
                                            <input type="email" class="form-control" id="CorreoElectronico" name="CorreoElectronico"
                                                placeholder="correo@ejemplo.com"
                                                value="<?php echo htmlspecialchars($datosUsuario['correo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                                required />
                                            <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" id="btnCambiarPerfil" name="btnCambiarPerfil"
                                            class="btn btn-lg text-white fw-semibold"
                                            style="background:#2ECC71; border:none;">
                                            <i class="lni lni-save me-2"></i>Guardar Cambios
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <a href="/G4_AmbienteWeb/Views/Seguridad/cambiarAcceso.php" class="text-decoration-none" style="color:#2ECC71;">
                                <i class="lni lni-lock me-1"></i>Cambiar contraseña
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <?php MostrarFooter(); ?>

    </main>

    <?php MostrarJS(); ?>
    <script src="../funciones/cambiarPerfil.js"></script>

</body>

</html>
