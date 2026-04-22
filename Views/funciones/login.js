document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formLogin');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    });

});
