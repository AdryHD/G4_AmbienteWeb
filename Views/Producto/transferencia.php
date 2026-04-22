<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/G4_AmbienteWeb/Views/layout.php";
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es">
<?php MostrarCSS(); ?>
<body>
<?php MostrarNav(); ?>

<main class="container py-5">
    <div class="card shadow border-0 rounded-4 mx-auto w-100" style="max-width: 600px;">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-4">
                <i class="lni lni-revenue mb-3 text-success" style="font-size: 3.5rem;"></i>
                <h4 class="fw-bold">Pago por Transferencia Bancaria</h4>
                <p class="text-muted small">Realiza tu pago y confirma los detalles abajo.</p>
            </div>

            <div class="bg-light border-start border-success border-5 p-3 mb-4 rounded-end shadow-sm">
                <h6 class="fw-bold text-success text-uppercase small mb-2">Nuestros Datos:</h6>
                <div class="row g-2 small">
                    <div class="col-4 fw-bold">Banco:</div><div class="col-8">Banco Nacional de Costa Rica</div>
                    <div class="col-4 fw-bold">Cuenta IBAN:</div><div class="col-8">CR05015100010010101010</div>
                    <div class="col-4 fw-bold">Titular:</div><div class="col-8 text-break">PowerZone S.A.</div>
                    <div class="col-4 fw-bold">Cédula:</div><div class="col-8">3-101-000000</div>
                </div>
            </div>

            <form id="formTransferencia" class="needs-validation" novalidate>
                <div class="alert alert-warning border-0 shadow-sm mb-4">
                    <small><i class="lni lni-warning me-2"></i>Su pedido no será enviado hasta que verifiquemos el depósito en nuestra cuenta.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Número de Comprobante / Referencia</label>
                    <input type="text" id="referencia" class="form-control" placeholder="Ej: 123456789" required>
                    <div class="invalid-feedback">Por favor ingrese el número de referencia.</div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="acepto" required>
                    <label class="form-check-label small" for="acepto">
                        He realizado la transferencia por el monto total.
                    </label>
                    <div class="invalid-feedback">Debe confirmar que realizó el pago.</div>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm" id="btnConfirmar">
                    <span id="textConfirmar">Confirmar y Finalizar Pedido</span>
                    <span id="loader" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                </button>
            </form>
        </div>
    </div>
</main>

<?php MostrarFooter(); ?>
<?php MostrarJS(); ?>
<script src="/G4_AmbienteWeb/Views/funciones/transferencia.js"></script>
</body>
</html>