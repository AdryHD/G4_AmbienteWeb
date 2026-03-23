(function () {
    'use strict';

    var form = document.getElementById('formCambiarAcceso');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        var nueva      = document.getElementById('NuevaContrasena');
        var confirmar  = document.getElementById('ConfirmarContrasena');

        // Validar coincidencia de contraseñas
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

    // Limpiar validación personalizada al escribir
    document.getElementById('ConfirmarContrasena').addEventListener('input', function () {
        this.setCustomValidity('');
    });

})();
