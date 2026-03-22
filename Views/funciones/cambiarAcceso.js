$(function () {

    $.validator.addMethod("sinEspacios", function (value) {
        return !/\s/.test(value);
    }, "La contraseña no debe contener espacios");

    $("#formCambiarAcceso").validate({
        rules: {
            NuevaContrasena: {
                required: true,
                minlength: 6,
                sinEspacios: true
            },
            ConfirmarContrasena: {
                required: true,
                equalTo: "#NuevaContrasena"
            }
        },
        messages: {
            NuevaContrasena: {
                required: "Campo obligatorio",
                minlength: "Mínimo 6 caracteres"
            },
            ConfirmarContrasena: {
                required: "Campo obligatorio",
                equalTo: "Las contraseñas no coinciden"
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
