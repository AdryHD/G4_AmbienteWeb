$(function () {
  $.validator.addMethod("passwordFuerte", function (value, element) {
    return this.optional(element) || 
      (/[a-z]/.test(value) && /[A-Z]/.test(value) && /[0-9]/.test(value));
  }, "La contraseña debe incluir mayúsculas, minúsculas y números");

  $("#formRegistro").validate({
    rules: {
      nombre: {
        required: true
      },
      correo: {
        required: true,
        email: true
      },
      contrasena: {
        required: true,
        minlength: 6,
        passwordFuerte: true
      },
      confirmar_contrasena: {
        required: true,
        equalTo: "#contrasena"
      }
    },
    messages: {
      nombre: {
        required: "Campo obligatorio"
      },
      correo: {
        required: "Campo obligatorio",
        email: "Formato incorrecto"
      },
      contrasena: {
        required: "Campo obligatorio",
        minlength: "Mínimo 6 caracteres",
        passwordFuerte: "Debe contener al menos una mayúscula, una minúscula y un número"
      },
      confirmar_contrasena: {
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
      $(element).removeClass("is-invalid").addClass("is-valid");
    },
    errorPlacement: function (error, element) {
      if (element.closest('.input-group').length) {
        error.insertAfter(element.closest('.input-group'));
      } else {
        error.insertAfter(element);
      }
    }
  });
});