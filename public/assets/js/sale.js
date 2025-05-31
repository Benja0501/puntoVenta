// public/assets/js/sale.js
document.addEventListener("DOMContentLoaded", function () {
    // ─────────────────────────────────────────────────────────────────────────
    // 1) Inicializar DataTable en el índice de ventas (si existe)
    // ─────────────────────────────────────────────────────────────────────────
    if (document.querySelector("#tableSales")) {
        $("#tableSales").DataTable({
            paging: true,
            ordering: true,
            info: true,
            responsive: true,
            language: {
                url: "/assets/js/plugins/datatables-es.json"
            },
        });
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 2) Variables comunes
    // ─────────────────────────────────────────────────────────────────────────
    const clientSel = document.getElementById("client_id");
    const taxInput  = document.getElementById("tax");

    // Para CREATE
    const tbodyCreate = document.getElementById("saleItems");
    const addLineBtn  = document.getElementById("addSaleLine");
    const formCreate  = document.getElementById("saleForm");

    // Para EDIT (si fuera necesario): los IDs llevan sufijo “Edit”
    const tbodyEdit      = document.getElementById("saleItemsEdit");
    const addLineBtnEdit = document.getElementById("addSaleLineEdit");
    const formEdit       = document.getElementById("saleFormEdit");

    // ─────────────────────────────────────────────────────────────────────────
    // 3) Función para poblar los <select class="sale-product"> dentro de un <tbody>
    // ─────────────────────────────────────────────────────────────────────────
    function refreshProductOptions(tbodySelector) {
        // window.saleProducts viene del blade como JSON de todos los productos:
        // [{ id, code, name, stock, image, sell_price, ... }, …]
        const opts = window.saleProducts
            .map(p => `<option value="${p.id}">${p.name}</option>`)
            .join("");

        tbodySelector.querySelectorAll(".sale-product").forEach(sel => {
            const currentVal = sel.value;
            sel.innerHTML = `<option value="">-- elegir producto --</option>${opts}`;
            if (currentVal) {
                sel.value = currentVal;
            }
        });
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 4) Función para recalcular subtotales y totales (CREATE u EDIT)
    // ─────────────────────────────────────────────────────────────────────────
    function recalcAll(
        tbodySelector,
        totalEl,
        taxPctEl,
        taxAmtEl,
        grandTotalEl
    ) {
        let total = 0;

        tbodySelector.querySelectorAll("tr").forEach(row => {
            const price    = parseFloat(row.querySelector(".line-price").value)    || 0;
            const qty      = parseInt(row.querySelector(".line-qty").value)       || 0;
            const discount = parseFloat(row.querySelector(".line-discount").value) || 0;
            // Ahora el descuento está en porcentaje (0–100), así que:
            // sub = price * qty * (1 - discount/100)
            const sub = (price * qty) * (1 - (discount / 100));
            row.querySelector(".line-subtotal").textContent = sub.toFixed(2);
            total += sub;
        });

        const taxPct = parseFloat(taxInput.value) || 0;
        const taxAmt = total * (taxPct / 100);
        const grand = total + taxAmt;

        totalEl.textContent      = total.toFixed(2);
        taxPctEl.textContent     = taxPct.toFixed(2);
        taxAmtEl.textContent     = taxAmt.toFixed(2);
        grandTotalEl.textContent = grand.toFixed(2);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 5) LÓGICA PARA CREATE
    // ─────────────────────────────────────────────────────────────────────────
    if (tbodyCreate && addLineBtn && formCreate) {
        // 5.1) Inicializamos primera fila: poblar select de productos + recalc
        refreshProductOptions(tbodyCreate);
        recalcAll(
            tbodyCreate,
            document.getElementById("totalAmount"),
            document.getElementById("taxPct"),
            document.getElementById("taxAmount"),
            document.getElementById("grandTotal")
        );

        // 5.2) Si cambiara el cliente (en este ejemplo no filtramos por cliente, 
        //      pero dejamos el listener por si luego filtraras productos por cliente)
        clientSel.addEventListener("change", () => {
            refreshProductOptions(tbodyCreate);
            recalcAll(
                tbodyCreate,
                document.getElementById("totalAmount"),
                document.getElementById("taxPct"),
                document.getElementById("taxAmount"),
                document.getElementById("grandTotal")
            );
        });

        // 5.3) Si el usuario escribe en precio, cantidad, descuento o impuesto, recalcular
        formCreate.addEventListener("input", e => {
            if (
                e.target.matches(".line-price, .line-qty, .line-discount") ||
                e.target === taxInput
            ) {
                recalcAll(
                    tbodyCreate,
                    document.getElementById("totalAmount"),
                    document.getElementById("taxPct"),
                    document.getElementById("taxAmount"),
                    document.getElementById("grandTotal")
                );
            }
        });

        // 5.4) Cuando se pulsa “+ Agregar producto”, clonamos la primera fila y refrescamos
        addLineBtn.addEventListener("click", () => {
            const firstRow = tbodyCreate.querySelector("tr");
            const newRow   = firstRow.cloneNode(true);
            // Limpiar valores de inputs y selects en la nueva fila
            newRow.querySelectorAll("input, select").forEach(el => el.value = "");
            tbodyCreate.appendChild(newRow);
            // Repoblar los <select class="sale-product"> de la nueva fila
            refreshProductOptions(tbodyCreate);
            recalcAll(
                tbodyCreate,
                document.getElementById("totalAmount"),
                document.getElementById("taxPct"),
                document.getElementById("taxAmount"),
                document.getElementById("grandTotal")
            );
        });

        // 5.5) Quitar línea (mantener al menos una fila)
        tbodyCreate.addEventListener("click", e => {
            if (e.target.matches(".btn-remove-line")) {
                const rows = tbodyCreate.querySelectorAll("tr");
                if (rows.length > 1) {
                    e.target.closest("tr").remove();
                    recalcAll(
                        tbodyCreate,
                        document.getElementById("totalAmount"),
                        document.getElementById("taxPct"),
                        document.getElementById("taxAmount"),
                        document.getElementById("grandTotal")
                    );
                }
            }
        });

        // 5.6) Al cambiar el <select class="sale-product"> copiamos el precio desde window.saleProducts
        tbodyCreate.addEventListener("change", e => {
            if (e.target.matches(".sale-product")) {
                const sel = e.target;
                const selectedId = parseInt(sel.value);
                // Buscar el producto seleccionado en el arreglo
                const found = window.saleProducts.find(p => p.id === selectedId);
                if (found) {
                    const row = sel.closest("tr");
                    const priceInput = row.querySelector(".line-price");

                    // **¡IMPORTANTE!** en tu migración el campo es “sell_price”:
                    priceInput.value = parseFloat(found.sell_price).toFixed(2);

                    // Si tuvieras otra columna (p. ej. “price”), reemplaza “sell_price” por esa clave:
                    // priceInput.value = parseFloat(found.price).toFixed(2);

                    // Volvemos a recalcular totales tras rellenar el precio:
                    recalcAll(
                        tbodyCreate,
                        document.getElementById("totalAmount"),
                        document.getElementById("taxPct"),
                        document.getElementById("taxAmount"),
                        document.getElementById("grandTotal")
                    );
                }
            }
        });
    }

    // ────────────────────────────────────────────────────────────────────────
    // 6) LÓGICA PARA EDIT (idéntica a CREATE, con sufijos “Edit”)
    // ────────────────────────────────────────────────────────────────────────
    if (tbodyEdit && addLineBtnEdit && formEdit) {
        refreshProductOptions(tbodyEdit);
        recalcAll(
            tbodyEdit,
            document.getElementById("totalAmountEdit"),
            document.getElementById("taxPctEdit"),
            document.getElementById("taxAmountEdit"),
            document.getElementById("grandTotalEdit")
        );

        clientSel.addEventListener("change", () => {
            refreshProductOptions(tbodyEdit);
            recalcAll(
                tbodyEdit,
                document.getElementById("totalAmountEdit"),
                document.getElementById("taxPctEdit"),
                document.getElementById("taxAmountEdit"),
                document.getElementById("grandTotalEdit")
            );
        });

        formEdit.addEventListener("input", e => {
            if (
                e.target.matches(".line-price, .line-qty, .line-discount") ||
                e.target === taxInput
            ) {
                recalcAll(
                    tbodyEdit,
                    document.getElementById("totalAmountEdit"),
                    document.getElementById("taxPctEdit"),
                    document.getElementById("taxAmountEdit"),
                    document.getElementById("grandTotalEdit")
                );
            }
        });

        addLineBtnEdit.addEventListener("click", () => {
            const firstRow = tbodyEdit.querySelector("tr");
            const newRow   = firstRow.cloneNode(true);
            newRow.querySelectorAll("input, select").forEach(el => el.value = "");
            tbodyEdit.appendChild(newRow);
            refreshProductOptions(tbodyEdit);
            recalcAll(
                tbodyEdit,
                document.getElementById("totalAmountEdit"),
                document.getElementById("taxPctEdit"),
                document.getElementById("taxAmountEdit"),
                document.getElementById("grandTotalEdit")
            );
        });

        tbodyEdit.addEventListener("click", e => {
            if (e.target.matches(".btn-remove-line")) {
                const rows = tbodyEdit.querySelectorAll("tr");
                if (rows.length > 1) {
                    e.target.closest("tr").remove();
                    recalcAll(
                        tbodyEdit,
                        document.getElementById("totalAmountEdit"),
                        document.getElementById("taxPctEdit"),
                        document.getElementById("taxAmountEdit"),
                        document.getElementById("grandTotalEdit")
                    );
                }
            }
        });

        // Al cambiar producto en EDIT, copiamos “sell_price” igual que en CREATE
        tbodyEdit.addEventListener("change", e => {
            if (e.target.matches(".sale-product")) {
                const sel = e.target;
                const selectedId = parseInt(sel.value);
                const found = window.saleProducts.find(p => p.id === selectedId);
                if (found) {
                    const row = sel.closest("tr");
                    const priceInput = row.querySelector(".line-price");
                    priceInput.value = parseFloat(found.sell_price).toFixed(2);
                    recalcAll(
                        tbodyEdit,
                        document.getElementById("totalAmountEdit"),
                        document.getElementById("taxPctEdit"),
                        document.getElementById("taxAmountEdit"),
                        document.getElementById("grandTotalEdit")
                    );
                }
            }
        });
    }
});
