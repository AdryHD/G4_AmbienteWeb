(function () {
    'use strict';

    const form = document.getElementById('formSimularPago');
    if (!form) return;

    const btn = document.getElementById('btnPagar');
    const loader = document.getElementById('loader');
    const text = document.getElementById('textPagar');

    const numTarjeta = document.getElementById('numTarjeta');
    const expiracion = document.getElementById('expiracion');
    const cvc = document.getElementById('cvc');

    expiracion.addEventListener('input', function (e) {
        let value = this.value.replace(/\D/g, ''); 
        if (value.length > 2) {
            this.value = value.slice(0, 2) + '/' + value.slice(2, 4);
        } else {
            this.value = value;
        }

        const mes = parseInt(value.slice(0, 2));
        if (value.length >= 2 && (mes < 1 || mes > 12)) {
            this.setCustomValidity('Mes inválido (01-12)');
        } else if (this.value.length < 5) {
            this.setCustomValidity('Formato incompleto (MM/AA)');
        } else {
            this.setCustomValidity('');
        }
    });

    numTarjeta.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
        this.setCustomValidity(this.value.length !== 16 ? 'Se requieren 16 dígitos.' : '');
    });

    cvc.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
        this.setCustomValidity(this.value.length !== 3 ? 'CVC inválido.' : '');
    });

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            ejecutarPago();
        }
        form.classList.add('was-validated');
    });

    function ejecutarPago() {
        btn.disabled = true;
        text.innerText = "Procesando...";
        loader.style.display = "inline-block";

        const datosEnvio = JSON.parse(localStorage.getItem('datos_envio'));


        fetch('/G4_AmbienteWeb/Controllers/CarritoController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest' 
            },
            body: new URLSearchParams({
                action: 'finalizar',
                ...datosEnvio
            })
        })
            .then(async response => {
                const textResp = await response.text();

                if (response.status === 401) {
                    // Sesión expirada
                    throw new Error('Sesión expirada. Por favor inicia sesión de nuevo.');
                }

                try {
                    return JSON.parse(textResp);
                } catch (e) {
                    console.error('Respuesta inesperada:', textResp);
                    throw new Error('Error en la respuesta del servidor.');
                }
            })
            .then(resp => {
                localStorage.removeItem('datos_envio');
                if (typeof showToast === 'function') showToast('¡Pedido finalizado con éxito!', 'success', 1000);
                // Redirigir al historial de compras sin cerrar sesión
                setTimeout(() => {
                    window.location.href = '/G4_AmbienteWeb/Views/Producto/HistorialCompras.php';
                }, 900);
            })
            .catch(err => {
                if (typeof showToast === 'function') showToast(err.message || 'Error al procesar el pago', 'danger', 1800);
                btn.disabled = false;
                text.innerText = 'Reintentar Pago';
                loader.style.display = 'none';
            });
    }
})();