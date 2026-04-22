<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
?>
<!DOCTYPE html>
<html lang="es">
<?php MostrarCSS(); ?>
<body>
<?php MostrarNav(); ?>

<main class="container py-5">
    <div class="card shadow border-0 rounded-4 mx-auto w-100" style="max-width: 500px;">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <i class="lni lni-credit-cards text-primary mb-3" style="font-size: 3rem;"></i>
                <h4 class="fw-bold">Finalizar Pago</h4>
                <p class="text-muted small">Pago totalmente seguro</p>
            </div>

            <form id="formSimularPago" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Número de Tarjeta</label>
                    <input type="text" id="numTarjeta" class="form-control" maxlength="16" placeholder="0000000000000000" required>
                    <div class="invalid-feedback">Ingrese los 16 dígitos de su tarjeta.</div>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Expiración</label>
                        <input type="text" id="expiracion" class="form-control" placeholder="MM/AA" maxlength="5" required>
                        <div class="invalid-feedback">Formato MM/AA.</div>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">CVC</label>
                        <input type="text" id="cvc" class="form-control" maxlength="3" placeholder="000" required>
                        <div class="invalid-feedback">3 dígitos.</div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg w-100 mt-3 shadow-sm" id="btnPagar">
                    <span id="textPagar">Pagar Ahora</span>
                    <span id="loader" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                </button>
            </form>
        </div>
    </div>
</main>

<?php MostrarFooter(); ?>
<?php MostrarJS(); ?>
<script src="/G4_AmbienteWeb/Views/funciones/pago.js"></script>
</body>
</html>