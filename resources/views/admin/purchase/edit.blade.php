<div class="modal fade" id="purchaseModalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditPurchase" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId">
                    <div class="mb-3">
                        <label for="editProvider" class="form-label">Proveedor</label>
                        <select name="provider_id" id="editProvider" class="form-select" required>
                            @foreach ($providers as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDate" class="form-label">Fecha de compra</label>
                        <input type="datetime-local" name="purchase_date" id="editDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTax" class="form-label">Impuesto</label>
                        <input type="number" step="0.01" name="tax" id="editTax" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="editTotal" class="form-label">Total</label>
                        <input type="number" step="0.01" name="total" id="editTotal" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Estado</label>
                        <select name="status" id="editStatus" class="form-select" required>
                            <option value="VALID">VALID</option>
                            <option value="CANCELED">CANCELED</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editPicture" class="form-label">Documento (opcional)</label>
                        <input type="file" name="picture" id="editPicture" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>
