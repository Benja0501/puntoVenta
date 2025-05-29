document.addEventListener("DOMContentLoaded", function () {
    // DataTable
    $("#tableClients").DataTable({
        paging: true,
        ordering: true,
        info: true,
        responsive: true,
        language: { url: "/assets/js/plugins/datatables-es.json" },
    });

    // Nuevo cliente
    document.getElementById("btnNuevoClient").addEventListener("click", () => {
        new bootstrap.Modal(
            document.getElementById("clientModalCreate")
        ).show();
    });

    // Mostrar cliente
    // document
    //     .getElementById("clientModalShow")
    //     .addEventListener("show.bs.modal", function (event) {
    //         const btn = event.relatedTarget;
    //         document.getElementById("showClientId").textContent =
    //             btn.dataset.id;
    //         document.getElementById("showClientName").textContent =
    //             btn.dataset.name;
    //         document.getElementById("showClientDni").textContent =
    //             btn.dataset.dni;
    //         document.getElementById("showClientRuc").textContent =
    //             btn.dataset.ruc || "-";
    //         document.getElementById("showClientAddress").textContent =
    //             btn.dataset.address || "-";
    //         document.getElementById("showClientPhone").textContent =
    //             btn.dataset.phone || "-";
    //         document.getElementById("showClientEmail").textContent =
    //             btn.dataset.email || "-";
    //         document.getElementById("showClientCreated").textContent =
    //             btn.dataset.created;
    //     });

    // Editar cliente
    document
        .getElementById("clientModalEdit")
        .addEventListener("show.bs.modal", function (event) {
            const btn = event.relatedTarget;
            const id = btn.dataset.id;
            const form = document.getElementById("formEditClient");
            form.action = `/clients/${id}`;

            document.getElementById("editId").value = id;
            document.getElementById("editName").value = btn.dataset.name;
            document.getElementById("editDni").value = btn.dataset.dni;
            document.getElementById("editRuc").value = btn.dataset.ruc;
            document.getElementById("editAddress").value = btn.dataset.address;
            document.getElementById("editPhone").value = btn.dataset.phone;
            document.getElementById("editEmail").value = btn.dataset.email;
        });
});
