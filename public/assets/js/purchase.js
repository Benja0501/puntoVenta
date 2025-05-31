document.addEventListener("DOMContentLoaded", function () {
    // ───────────────────────────────────────────────────────────────────────────
    // 1) Inicializar DataTable en el índice de compras
    // ───────────────────────────────────────────────────────────────────────────
    if (document.querySelector("#tablePurchases")) {
        $("#tablePurchases").DataTable({
            paging: true,
            ordering: true,
            info: true,
            responsive: true,
            language: { url: "/assets/js/plugins/datatables-es.json" },
        });
    }

    // ───────────────────────────────────────────────────────────────────────────
    // 2) Lógica de /purchases/create
    // ───────────────────────────────────────────────────────────────────────────
    const providerSel = document.getElementById("provider");
    const taxInput = document.getElementById("tax");
    const tbody = document.getElementById("purchaseItems");
    const addLineBtn = document.getElementById("addPurchaseLine");
    const form = document.getElementById("purchaseForm");

    if (providerSel && taxInput && tbody && addLineBtn && form) {
        // 2.1) Repuebla los <select> de productos según el proveedor seleccionado
        function refreshProductOptions() {
            const provId = providerSel.value;
            const opts = window.purchaseProducts
                .filter((p) => String(p.provider_id) === provId)
                .map((p) => `<option value="${p.id}">${p.name}</option>`)
                .join("");
            tbody.querySelectorAll(".purchase-product").forEach((sel) => {
                sel.innerHTML = `<option value="">-- elegir producto --</option>${opts}`;
            });
        }

        // 2.2) Recalcula subtotales y totales de toda la tabla
        function recalcAll() {
            let subtotal = 0;
            tbody.querySelectorAll("tr").forEach((row) => {
                const price =
                    parseFloat(row.querySelector(".line-price").value) || 0;
                const qty = parseInt(row.querySelector(".line-qty").value) || 0;
                const lineTotal = price * qty;
                row.querySelector(".line-subtotal").textContent =
                    lineTotal.toFixed(2);
                subtotal += lineTotal;
            });

            const taxPct = parseFloat(taxInput.value) || 0;
            const taxAmt = subtotal * (taxPct / 100);
            const grand = subtotal + taxAmt;

            document.getElementById("totalAmount").textContent =
                subtotal.toFixed(2);
            document.getElementById("taxPct").textContent = taxPct.toFixed(2);
            document.getElementById("taxAmount").textContent =
                taxAmt.toFixed(2);
            document.getElementById("grandTotal").textContent =
                grand.toFixed(2);
        }

        // Al cambiar el proveedor → recarga productos y totales
        providerSel.addEventListener("change", () => {
            refreshProductOptions();
            recalcAll();
        });

        // Al cambiar precio, cantidad o impuesto → recálculo
        form.addEventListener("input", (e) => {
            if (
                e.target.matches(".line-price, .line-qty") ||
                e.target === taxInput
            ) {
                recalcAll();
            }
        });

        // Botón “Agregar producto”
        addLineBtn.addEventListener("click", () => {
            const firstRow = tbody.querySelector("tr");
            const newRow = firstRow.cloneNode(true);
            newRow
                .querySelectorAll("input, select")
                .forEach((el) => (el.value = ""));
            tbody.appendChild(newRow);
            refreshProductOptions();
            recalcAll();
        });

        // Botón “×” Quitar línea (mantener al menos 1 línea)
        tbody.addEventListener("click", (e) => {
            if (e.target.matches(".btn-remove-line")) {
                const rows = tbody.querySelectorAll("tr");
                if (rows.length > 1) {
                    e.target.closest("tr").remove();
                    recalcAll();
                }
            }
        });

        // Inicialización al cargar la página
        refreshProductOptions();
        recalcAll();
    }

    // ───────────────────────────────────────────────────────────────────────────
    // 3) Rellenar modal “Ver compra”
    // ───────────────────────────────────────────────────────────────────────────
    const showModal = document.getElementById("purchaseModalShow");
    if (showModal) {
        showModal.addEventListener("show.bs.modal", (event) => {
            const btn = event.relatedTarget;
            document.getElementById("showPurchaseId").textContent =
                btn.dataset.id;
            document.getElementById("showPurchaseProvider").textContent =
                btn.dataset.provider;
            document.getElementById("showPurchaseUser").textContent =
                btn.dataset.user;
            document.getElementById("showPurchaseDate").textContent =
                btn.dataset.date;
            document.getElementById("showPurchaseTax").textContent =
                btn.dataset.tax;
            document.getElementById("showPurchaseTotal").textContent =
                btn.dataset.total;
            document.getElementById("showPurchaseStatus").textContent =
                btn.dataset.status;

            const picWrapper = document.getElementById(
                "showPurchasePictureWrapper"
            );
            const picImg = document.getElementById("showPurchasePicture");
            if (btn.dataset.picture) {
                picImg.src = "/" + btn.dataset.picture;
                picWrapper.style.display = "block";
            } else {
                picWrapper.style.display = "none";
            }
        });
    }

    // ───────────────────────────────────────────────────────────────────────────
    // 4) Rellenar modal “Editar compra”
    // ───────────────────────────────────────────────────────────────────────────
    const editModal = document.getElementById("purchaseModalEdit");
    if (editModal) {
        editModal.addEventListener("show.bs.modal", (event) => {
            const btn = event.relatedTarget;
            const formEdit = document.getElementById("formEditPurchase");
            if (formEdit) {
                formEdit.action = "/purchases/" + btn.dataset.id;
                document.getElementById("editProvider").value =
                    btn.dataset.providerId;
                document.getElementById("editDate").value = btn.dataset.date
                    .replace(" ", "T")
                    .substring(0, 16);
                document.getElementById("editTax").value = btn.dataset.tax;
                document.getElementById("editTotal").value = btn.dataset.total;
                document.getElementById("editStatus").value =
                    btn.dataset.status;
            }
        });
    }
});
