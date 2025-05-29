<!-- Modal Crear Cliente -->
<div class="modal fade" id="clientModalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="createName" class="form-label">Nombre</label>
                        <input type="text" name="name" id="createName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="createDni" class="form-label">DNI</label>
                        <input type="text" name="dni" id="createDni" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="createRuc" class="form-label">RUC</label>
                        <input type="text" name="ruc" id="createRuc" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="createAddress" class="form-label">Dirección</label>
                        <input type="text" name="address" id="createAddress" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="createPhone" class="form-label">Teléfono</label>
                        <input type="text" name="phone" id="createPhone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="createEmail" class="form-label">Email</label>
                        <input type="email" name="email" id="createEmail" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
