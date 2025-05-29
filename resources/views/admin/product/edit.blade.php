<div class="modal fade" id="productModalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditProduct" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="editCode" class="form-label">Código</label>
                        <input type="text" name="code" id="editCode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editName" class="form-label">Nombre</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="editStock" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Imagen (opcional)</label>
                        <input type="file" name="image" id="editImage" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editPrice" class="form-label">Precio de venta</label>
                        <input type="text" name="sell_price" id="editPrice" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Estado</label>
                        <select name="status" id="editStatus" class="form-select" required>
                            <option value="ACTIVE">Activo</option>
                            <option value="INACTIVE">Inactivo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editCategory" class="form-label">Categoría</label>
                        <select name="category_id" id="editCategory" class="form-select" required>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editProvider" class="form-label">Proveedor</label>
                        <select name="provider_id" id="editProvider" class="form-select" required>
                            @foreach ($providers as $pr)
                                <option value="{{ $pr->id }}">{{ $pr->name }}</option>
                            @endforeach
                        </select>
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
