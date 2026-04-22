(function () {
    'use strict';

    var form = document.getElementById('formCambiarAcceso');
    if (!form) return;

    var nueva     = document.getElementById('NuevaContrasena');
    var confirmar = document.getElementById('ConfirmarContrasena');

    // ── Validación al enviar ──────────────────────────────────────
    form.addEventListener('submit', function (event) {
        if (nueva.value !== confirmar.value) {
            confirmar.setCustomValidity('Las contraseñas no coinciden.');
        } else {
            confirmar.setCustomValidity('');
        }

        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    });

    // ── Validación en tiempo real ─────────────────────────────────
    confirmar.addEventListener('input', function () {
        if (this.value !== nueva.value) {
            this.setCustomValidity('Las contraseñas no coinciden.');
        } else {
            this.setCustomValidity('');
        }
    });



})();
