(function () {
    'use strict';

    var form = document.getElementById('formCambiarPerfil');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

})();

function ConsultarNombre() {
    let cedula = document.getElementById('Cedula').value.trim();

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
