@include('layouts.template.header_admin')

<main class="app-main">
    <!-- Cabecera -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Registro de compra
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Compras</a></li>
                        <li class="breadcrumb-item active">Registro de compra</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('purchases.store') }}" method="POST" id="purchaseForm">
                @csrf
                <div class="card mb-4 p-3">
                    <!-- Proveedor & Impuesto -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Proveedor</label>
                            <select id="provider" name="provider_id" class="form-select" required>
                                <option value="">-- Elige proveedor --</option>
                                @foreach ($providers as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Impuesto (%)</label>
                            <input type="number" name="tax" id="tax" class="form-control" value="18"
                                min="0" step="0.01" required>
                        </div>
                    </div>

                    <!-- Detalles de compra -->
                    <hr>
                    <h5>Detalles de compra</h5>
                    <table class="table table-bordered" id="purchaseDetailsTable">
                        <thead class="table-light">
                            <tr>
                                <th style="width:1%">#</th>
                                <th>Producto</th>
                                <th style="width:20%">Precio de compra (PEN)</th>
                                <th style="width:12%">Cantidad</th>
                                <th style="width:14%">Sub-Total (PEN)</th>
                                <th style="width:1%"></th>
                            </tr>
                        </thead>
                        <tbody id="purchaseItems">
                            <tr>
                                <td class="line-index">1</td>
                                <td>
                                    <select name="product_id[]" class="form-select purchase-product" required>
                                        <option value="">-- primero proveedor --</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="price[]" class="form-control line-price" min="0"
                                        step="0.01" required>
                                </td>
                                <td>
                                    <input type="number" name="quantity[]" class="form-control line-qty" min="1"
                                        step="1" required>
                                </td>
                                <td class="line-subtotal text-end">0.00</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger btn-remove-line">×</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">SUBTOTAL:</th>
                                <th id="totalAmount" class="text-end">0.00</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">TOTAL IMPUESTO (<span id="taxPct">18</span>%):
                                </th>
                                <th id="taxAmount" class="text-end">0.00</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">TOTAL A PAGAR:</th>
                                <th id="grandTotal" class="text-end">0.00</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="mb-3">
                        <button type="button" id="addPurchaseLine" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i> Agregar producto
                        </button>
                    </div>

                    <!-- Acciones -->
                    <div class="text-end">
                        <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

@include('layouts.template.footer_admin')

{{-- Exponemos todos los productos al frontend --}}
<script>
    window.purchaseProducts = @json($products);
</script>

{{-- Incluimos el JS de comportamiento --}}
<script src="{{ asset('assets/js/purchase.js') }}"></script>
