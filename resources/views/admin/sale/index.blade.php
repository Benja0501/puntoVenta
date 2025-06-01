{{-- resources/views/admin/sale/index.blade.php --}}
@include('layouts.template.header_admin')

<main class="app-main">
    <!-- Cabecera -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-cash-register"></i>
                        Ventas
                    </h3>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('sales.create') }}" class="btn btn-primary float-end">
                        <i class="fa fa-plus"></i> Nueva Venta
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de ventas -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card p-3">
                <table id="tableSales" class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->sale_date->format('d/m/Y H:i') }}</td>
                                <td>{{ $sale->client->name }}</td>
                                <td>S/ {{ number_format($sale->total, 2) }}</td>
                                <td>{{ $sale->status }}</td>
                                <td>
                                    <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    {{-- <a href="{{ route('sales.edit', $sale) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a> --}}
                                    {{-- PDF: abrimos en nueva pestaña/ventana (target="_blank") --}}
                                    <a href="{{ route('sales.pdf', $sale) }}" class="btn btn-sm btn-danger"
                                        target="_blank" title="Descargar PDF">
                                        <i class="fa fa-file-pdf"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
{{-- Scripts --}}
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/plugins/dataTable.js') }}"></script>
<script src="{{ asset('assets/js/sale.js') }}"></script>

@include('layouts.template.footer_admin')
