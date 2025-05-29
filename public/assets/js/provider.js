document.addEventListener("DOMContentLoaded", function () {
    // Inicializar DataTable para proveedores
    $("#tableProviders").DataTable({
        paging: true,
        ordering: true,
        info: true,
        responsive: true,
        language: { url: "/assets/js/plugins/datatables-es.json" },
    });

    // Modal Mostrar detalles proveedor
    // var showModal = document.getElementById("providerModalShow");
    // showModal.addEventListener("show.bs.modal", function (event) {
    //     var btn = event.relatedTarget;
    //     document.getElementById("showProviderId").textContent =
    //         btn.getAttribute("data-id");
    //     document.getElementById("showProviderName").textContent =
    //         btn.getAttribute("data-name");
    //     document.getElementById("showProviderEmail").textContent =
    //         btn.getAttribute("data-email");
    //     document.getElementById("showProviderRuc").textContent =
    //         btn.getAttribute("data-ruc");
    //     document.getElementById("showProviderAddress").textContent =
    //         btn.getAttribute("data-address") || "-";
    //     document.getElementById("showProviderPhone").textContent =
    //         btn.getAttribute("data-phone");
    //     document.getElementById("showProviderCreated").textContent =
    //         btn.getAttribute("data-created");
    // });

    // Modal Editar proveedor
    var editModal = document.getElementById("providerModalEdit");
    editModal.addEventListener("show.bs.modal", function (event) {
        var btn = event.relatedTarget;
        var id = btn.getAttribute("data-id");
        var form = document.getElementById("formEditProvider");
        form.action = "/providers/" + id;

        document.getElementById("editProviderName").value =
            btn.getAttribute("data-name");
        document.getElementById("editProviderEmail").value =
            btn.getAttribute("data-email");
        document.getElementById("editProviderRuc").value =
            btn.getAttribute("data-ruc");
        document.getElementById("editProviderAddress").value =
            btn.getAttribute("data-address") || "";
        document.getElementById("editProviderPhone").value =
            btn.getAttribute("data-phone");
    });

    // Modal Crear proveedor (botón Nuevo)
    const btnNuevo = document.querySelector("#btnNuevoProvider");
    if (btnNuevo) {
        btnNuevo.addEventListener("click", () => {
            const modalEl = document.getElementById("providerModalCreate");
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        });
    }
});
