document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formRegistro');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        const contrasena = document.getElementById('contrasena');
        const confirmar  = document.getElementById('confirmar_contrasena');

        // Validar que las contraseñas coincidan
        if (contrasena && confirmar && contrasena.value !== confirmar.value) {
            confirmar.setCustomValidity('Las contraseñas no coinciden');
        } else if (confirmar) {
            confirmar.setCustomValidity('');
        }

        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }

        form.classList.add('was-validated');
    });

    // Limpiar error de confirmar cuando el usuario escribe
    const confirmar = document.getElementById('confirmar_contrasena');
    if (confirmar) {
        confirmar.addEventListener('input', function () {
            this.setCustomValidity('');
        });
    }
});
