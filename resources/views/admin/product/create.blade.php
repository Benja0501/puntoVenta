<div class="modal fade" id="productModalCreate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="createCode" class="form-label">Código</label>
                        <input type="text" name="code" id="createCode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="createName" class="form-label">Nombre</label>
                        <input type="text" name="name" id="createName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="createStock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="createStock" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="createImage" class="form-label">Imagen</label>
                        <input type="file" name="image" id="createImage" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="createPrice" class="form-label">Precio de venta</label>
                        <input type="text" name="sell_price" id="createPrice" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="createStatus" class="form-label">Estado</label>
                        <select name="status" id="createStatus" class="form-select" required>
                            <option value="ACTIVE">Activo</option>
                            <option value="INACTIVE">Inactivo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="createCategory" class="form-label">Categoría</label>
                        <select name="category_id" id="createCategory" class="form-select" required>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="createProvider" class="form-label">Proveedor</label>
                        <select name="provider_id" id="createProvider" class="form-select" required>
                            @foreach ($providers as $pr)
                                <option value="{{ $pr->id }}">{{ $pr->name }}</option>
                            @endforeach
                        </select>
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
