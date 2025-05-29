<!-- Modal Editar Cliente -->
<div class="modal fade" id="clientModalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditClient" method="POST">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nombre</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="editDni" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRuc" class="form-label">RUC</label>
                        <input type="text" name="ruc" id="editRuc" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Dirección</label>
                        <input type="text" name="address" id="editAddress" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Teléfono</label>
                        <input type="text" name="phone" id="editPhone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control">
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
