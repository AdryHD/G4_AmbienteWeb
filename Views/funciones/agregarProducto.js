$(function () {

    // Método custom: solo PNG, JPG o JPEG
    $.validator.addMethod("soloImagen", function (value, element) {
        if (element.files && element.files.length > 0) {
            return /\.(png|jpe?g)$/i.test(element.files[0].name);
        }
        return true;
    }, "Solo se permiten archivos PNG o JPG");

    // Mostrar nombre del archivo seleccionado
    $("#ImagenProducto").on("change", function () {
        const nombreSpan  = $("#nombreArchivo");
        const feedbackImg = $("#feedbackImagen");
        if (this.files && this.files.length > 0) {
            nombreSpan.text(this.files[0].name).css("color", "#1A8A4A");
            feedbackImg.hide();
        } else {
            nombreSpan.text("Ningún archivo seleccionado").css("color", "");
        }
    });

    // Precio: solo números/punto, formatear a 2 decimales al salir
    $("input[name='precio']").on("input", function () {
        $(this).val($(this).val().replace(/[^0-9.]/g, ""));
    }).on("blur", function () {
        const num = parseFloat($(this).val());
        if (!isNaN(num) && num >= 0) {
            $(this).val(num.toFixed(2));
        }
    });

    // Stock: solo enteros positivos
    $("input[name='stock']").on("input", function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ""));
    });

    // Validación con jQuery Validate
    $("#formAgregarProducto").validate({
        rules: {
            id_categoria: {
                required: true
            },
            nombre: {
                required: true
            },
            descripcion: {
                required: true
            },
            precio: {
                required: true,
                number: true,
                min: 0.01
            },
            stock: {
                required: true,
                digits: true,
                min: 0
            },
            ImagenProducto: {
                required: true,
                soloImagen: true
            }
        },
        messages: {
            id_categoria: {
                required: "Seleccione una categoría"
            },
            nombre: {
                required: "Campo obligatorio"
            },
            descripcion: {
                required: "Campo obligatorio"
            },
            precio: {
                required: "Campo obligatorio",
                number: "Ingrese un precio válido",
                min: "El precio debe ser mayor a 0"
            },
            stock: {
                required: "Campo obligatorio",
                digits: "Solo se permiten números enteros",
                min: "El stock no puede ser negativo"
            },
            ImagenProducto: {
                required: "Seleccione una imagen"
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
