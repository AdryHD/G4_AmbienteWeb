$(function () {

    $("#formCambiarPerfil").validate({
        rules: {
            nombre: {
                required: true
            },
            correo: {
                required: true,
                email: true
            }
        },
        messages: {
            nombre: {
                required: "Campo obligatorio"
            },
            correo: {
                required: "Campo obligatorio",
                email: "Formato incorrecto"
            }
        },
        errorElement: "span",
        errorClass: "text-danger",
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        }
    });

});
