(function () {
    'use strict';

    var form = document.getElementById('formRecuperarAcceso');
    if (!form) return;

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });

})();
