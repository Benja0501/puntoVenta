document.addEventListener("DOMContentLoaded", function () {
    // ————— Tu DataTable como antes —————
    $("#tableCategorias").DataTable({
        // dom: "Bfrtip",
        paging: true,
        ordering: true,
        info: true,
        responsive: true,
        language: { url: "/assets/js/plugins/datatables-es.json" },
    });

    // ————— Abrir Modal “Nuevo” —————
    const btnNuevo = document.querySelector("#btnNuevo");
    if (btnNuevo) {
        btnNuevo.addEventListener("click", () => {
            new bootstrap.Modal(
                document.getElementById("categoryModalCreate")
            ).show();
        });
    }

    // ————— Listener único para el Modal de edición —————
    const editModal = document.getElementById("categoryModalEdit");
    editModal.addEventListener("show.bs.modal", function (event) {
        // Botón que dispara el modal
        const button = event.relatedTarget;
        const id = button.getAttribute("data-id");
        const name = button.getAttribute("data-name");
        const description = button.getAttribute("data-description");

        // Montamos la URL PUT /categories/{id} en el form
        const form = editModal.querySelector("#formEditCategory");
        form.action = `/categories/${id}`;

        // Rellenamos los inputs (asegúrate que los id aquí existan en el modal)
        editModal.querySelector("#editName").value = name;
        editModal.querySelector("#editDescription").value = description;
    });

    // ————— Ver categoría —————
    var showModal = document.getElementById("categoryModalShow");
    showModal.addEventListener("show.bs.modal", function (event) {
        var btn = event.relatedTarget;
        var id = btn.getAttribute("data-id");
        var name = btn.getAttribute("data-name");
        var desc = btn.getAttribute("data-description");
        var created = btn.getAttribute("data-created_at");

        // Rellenamos el modal
        showModal.querySelector("#showId").textContent = id;
        showModal.querySelector("#showName").textContent = name;
        showModal.querySelector("#showDescription").textContent = desc;
        showModal.querySelector("#showCreatedAt").textContent = created;
    });
});
