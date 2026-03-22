function CerrarSesion() {
    $.ajax({
        url: '/G4_AmbienteWeb/Controllers/HomeController.php',
        method: 'POST',
        dataType: 'json',
        data: { btnCerrarSesion: true },
        success: function (response) {
            window.location.href = '/G4_AmbienteWeb/Views/Home/inicio.php';
        }
    });
};
