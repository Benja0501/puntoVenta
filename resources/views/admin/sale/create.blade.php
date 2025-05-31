

{{-- resources/views/admin/sale/create.blade.php --}}
@include('layouts.template.header_admin')

<main class="app-main">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $msg)
                <li>{{ $msg }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Cabecera -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-cart-plus"></i>
                        Registro de Venta
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
                        <li class="breadcrumb-item active">Registro de Venta</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="app-content">
        <div class="container-fluid">
            <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
                @csrf
                <div class="card mb-4 p-3">
                    <!-- Cliente & Impuesto -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Cliente</label>
                            <select id="client_id" name="client_id" class="form-select" required>
                                <option value="">-- Elige cliente --</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Impuesto (%)</label>
                            <input type="number" name="tax" id="tax" class="form-control" value="18"
                                min="0" step="0.01" required>
                        </div>
                    </div>

                    <!-- Detalles de venta -->
                    <hr>
                    <h5>Detalles de Venta</h5>
                    <table class="table table-bordered" id="saleDetailsTable">
                        <thead class="table-light">
                            <tr>
                                <th style="width:1%">#</th>
                                <th>Producto</th>
                                <th style="width:20%">Precio de venta (PEN)</th>
                                <th style="width:12%">Cantidad</th>
                                <th style="width:15%">Descuento (%)</th>
                                <th style="width:14%">Sub-Total (PEN)</th>
                                <th style="width:1%"></th>
                            </tr>
                        </thead>
                        <tbody id="saleItems">
                            <tr>
                                <td class="line-index">1</td>
                                <td>
                                    <select name="product_id[]" class="form-select sale-product" required>
                                        <option value="">-- selecciona producto --</option>
                                        @foreach ($products as $prod)
                                            <option value="{{ $prod->id }}">
                                                {{ $prod->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <!-- Hacemos el precio readonly para que se complete automáticamente -->
                                    <input type="number" name="price[]" class="form-control line-price" min="0"
                                        step="0.01" readonly required>
                                </td>
                                <td>
                                    <input type="number" name="quantity[]" class="form-control line-qty" min="1"
                                        step="1" value="1" required>
                                </td>
                                <td>
                                    <!-- Ahora el descuento es porcentaje -->
                                    <input type="number" name="discount[]" class="form-control line-discount"
                                        min="0" max="100" step="0.01" value="0" required>
                                </td>
                                <td class="line-subtotal text-end">0.00</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger btn-remove-line">×</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-end">TOTAL:</th>
                                <th id="totalAmount" class="text-end">0.00</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-end">
                                    TOTAL IMPUESTO (<span id="taxPct">18</span>%):
                                </th>
                                <th id="taxAmount" class="text-end">0.00</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-end">TOTAL A PAGAR:</th>
                                <th id="grandTotal" class="text-end">0.00</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="mb-3">
                        <button type="button" id="addSaleLine" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i> Agregar producto
                        </button>
                    </div>

                    <!-- Acciones -->
                    <div class="text-end">
                        <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

@include('layouts.template.footer_admin')

{{-- Exponemos todos los productos al frontend (para poblar precios) --}}
<script>
    window.saleProducts = @json($products);
</script>
<script src="{{ asset('assets/js/sale.js') }}"></script>
