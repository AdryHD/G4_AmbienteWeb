document.addEventListener('DOMContentLoaded', function () {

    const form        = document.getElementById('formRegistro');
    if (!form) return;

    const contrasena  = document.getElementById('Contrasenna');
    const confirmar   = document.getElementById('ConfirmarContrasenna');

    // ── Validación al enviar ──────────────────────────────────────
    form.addEventListener('submit', function (e) {
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

    // ── Validación en tiempo real ─────────────────────────────────
    if (confirmar) {
        confirmar.addEventListener('input', function () {
            if (contrasena && this.value !== contrasena.value) {
                this.setCustomValidity('Las contraseñas no coinciden');
            } else {
                this.setCustomValidity('');
            }
        });
    }



});

function ConsultarNombre() {
    let cedula = document.getElementById('Identificacion').value.trim();

    if (cedula.length >= 9) {
        fetch('https://apis.gometa.org/cedulas/' + cedula)
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.resultcount > 0) {
                    document.getElementById('Nombre').value = data.nombre;
                }
            })
            .catch(function (err) {
                console.error('Error consultando cédula:', err);
            });
    }
}
