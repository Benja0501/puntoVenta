<!-- Modal editar proveedor -->
<div class="modal fade" id="providerModalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditProvider" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editProviderName" class="form-label">Nombre</label>
                        <input type="text" name="name" id="editProviderName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProviderEmail" class="form-label">Email</label>
                        <input type="email" name="email" id="editProviderEmail" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProviderRuc" class="form-label">RUC</label>
                        <input type="text" name="ruc_number" id="editProviderRuc" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProviderAddress" class="form-label">Dirección</label>
                        <input type="text" name="address" id="editProviderAddress" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editProviderPhone" class="form-label">Teléfono</label>
                        <input type="text" name="phone" id="editProviderPhone" class="form-control" required>
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
