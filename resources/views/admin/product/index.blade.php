@include('layouts.template.header_admin')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-box"></i> Productos
                        <small>Tienda JEMP</small>
                        <button id="btnNuevoProduct" class="btn btn-secondary ms-3">
                            <i class="fa-solid fa-plus"></i> Nuevo
                        </button>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-body">
                    <table id="tableProducts" class="display table table-striped table-bordered nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                {{-- <th>Categoría</th>
                                <th>Proveedor</th> --}}
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->code }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->stock }}</td>
                                    <td>{{ number_format($p->sell_price, 2) }}</td>
                                    <td>{{ $p->status }}</td>
                                    {{-- <td>{{ $p->category->name }}</td>
                                    <td>{{ $p->provider->name }}</td> --}}
                                    <td>
                                        <!-- Show -->
                                        <a href="{{ route('products.show', $p) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                        </a>
                                        <!-- Edit -->
                                        <button class="btn btn-sm btn-primary btn-edit-product" data-bs-toggle="modal"
                                            data-bs-target="#productModalEdit" data-id="{{ $p->id }}"
                                            data-code="{{ $p->code }}" data-name="{{ $p->name }}"
                                            data-stock="{{ $p->stock }}" data-price="{{ $p->sell_price }}"
                                            data-status="{{ $p->status }}" data-category-id="{{ $p->category_id }}"
                                            data-provider-id="{{ $p->provider_id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <!-- Delete -->
                                        <form action="{{ route('products.destroy', $p) }}" method="POST"
                                            style="display:inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Eliminar producto?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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

@include('admin.product.create')
@include('admin.product.edit')

<!-- Scripts -->
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/plugins/dataTable.js') }}"></script>
<script src="{{ asset('assets/js/product.js') }}"></script>

@include('layouts.template.footer_admin')
