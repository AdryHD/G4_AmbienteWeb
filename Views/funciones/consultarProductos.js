$(function () {
    new DataTable("#tProductos", {
        language: {
            url: "https://cdn.datatables.net/plug-ins/2.3.7/i18n/es-ES.json"
        },
        ordering: false,
        columnDefs: [{ className: "dt-left px-2", targets: "_all" }]
    });
});
