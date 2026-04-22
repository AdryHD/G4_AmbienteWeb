(function () {
    'use strict';

    const form = document.getElementById('formTransferencia');
    if (!form) return;

    const btn = document.getElementById('btnConfirmar');
    const loader = document.getElementById('loader');
    const text = document.getElementById('textConfirmar');

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            procesarPedidoTransferencia();
        }
        form.classList.add('was-validated');
    });

    function procesarPedidoTransferencia() {
        btn.disabled = true;
        text.innerText = "Registrando pedido...";
        loader.style.display = "inline-block";

        const datosEnvio = JSON.parse(localStorage.getItem('datos_envio'));

        if (!datosEnvio) {
            alert('Error: No se encontraron datos de envío.');
            window.location.href = '/G4_AmbienteWeb/Views/Carrito/carrito.php';
            return;
        }

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
            let rawText = await response.text();
            rawText = rawText.trim();
            if (rawText.startsWith('(')) rawText = rawText.substring(1);

            try {
                return JSON.parse(rawText);
            } catch (e) {
                console.error("Respuesta fallida:", rawText);
                throw new Error("Error al procesar la respuesta del servidor.");
            }
        })
        .then(resp => {
            localStorage.removeItem('datos_envio');
            alert('Trasnferencia enviada, en breve un empleado verificará su validez.');
            window.location.href = '/G4_AmbienteWeb/Views/Producto/HistorialCompras.php';
        })
        .catch(err => {
            alert(err.message);
            btn.disabled = false;
            text.innerText = "Confirmar Envío";
            loader.style.display = "none";
        });
    }
})();