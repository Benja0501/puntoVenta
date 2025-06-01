{{-- Incluye tu header común --}}
@include('layouts.template.header_admin')

<main class="app-main">
    <!-- Cabecera -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-cart-plus"></i> Compras
                        <small>Tienda JEMP</small>
                        <a href="{{ route('purchases.create') }}" class="btn btn-secondary ms-3">
                            <i class="fa-solid fa-plus"></i> Nuevo
                        </a>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Compras</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-body">
                    <table id="tablePurchases" class="display table table-striped table-bordered nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $pur)
                                <tr>
                                    <td>{{ $pur->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pur->purchase_date)->format('d/m/Y H:i') }}</td>
                                    <td>{{ number_format($pur->total, 2) }}</td>
                                    <td>{{ $pur->status }}</td>
                                    <td>
                                        <!-- Show -->
                                        <a href="{{ route('purchases.show', $pur) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        {{-- <!-- Edit -->
                                        <button class="btn btn-sm btn-primary btn-edit-purchase" data-bs-toggle="modal"
                                            data-bs-target="#purchaseModalEdit" data-id="{{ $pur->id }}"
                                            data-provider-id="{{ $pur->provider_id }}"
                                            data-user-id="{{ $pur->user_id }}" data-date="{{ $pur->purchase_date }}"
                                            data-tax="{{ $pur->tax }}" data-total="{{ $pur->total }}"
                                            data-status="{{ $pur->status }}"><i class="fa fa-edit"></i></button> --}}

                                        {{-- <!-- Delete -->
                                        <form action="{{ route('purchases.destroy', $pur) }}" method="POST"
                                            style="display:inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Eliminar compra?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form> --}}
                                        <a href="{{ route('purchases.pdf', $pur) }}" class="btn btn-sm btn-secondary"
                                            title="Descargar PDF">
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
    </div>
</main>

@include('admin.purchase.edit')

{{-- Scripts --}}
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/plugins/dataTable.js') }}"></script>
<script src="{{ asset('assets/js/purchase.js') }}"></script>

@include('layouts.template.footer_admin')
