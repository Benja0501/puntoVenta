document.addEventListener("DOMContentLoaded", function () {
    // Inicializar DataTable
    $("#tableProducts").DataTable({
        paging: true,
        ordering: true,
        info: true,
        responsive: true,
        language: { url: "/assets/js/plugins/datatables-es.json" },
    });

    // Nuevo
    document.getElementById("btnNuevoProduct").addEventListener("click", () => {
        new bootstrap.Modal(
            document.getElementById("productModalCreate")
        ).show();
    });
    // Edit
    document
        .getElementById("productModalEdit")
        .addEventListener("show.bs.modal", function (event) {
            const btn = event.relatedTarget;
            const id = btn.dataset.id;
            const form = document.getElementById("formEditProduct");
            form.action = "/products/" + id;

            document.getElementById("editId").value = id;
            document.getElementById("editCode").value = btn.dataset.code;
            document.getElementById("editName").value = btn.dataset.name;
            document.getElementById("editStock").value = btn.dataset.stock;
            document.getElementById("editPrice").value = btn.dataset.price;
            document.getElementById("editStatus").value = btn.dataset.status;
            document.getElementById("editCategory").value =
                btn.dataset.categoryId;
            document.getElementById("editProvider").value =
                btn.dataset.providerId;
        });
});
