@include('layouts.template.header_admin')

<main class="app-main">
    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-user"></i>
                        Clientes
                        <small>Tienda JEMP</small>
                        <button id="btnNuevoClient" type="button" class="btn btn-secondary mb-2 ms-3">
                            <i class="fa-solid fa-plus"></i> Nuevo
                        </button>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-body">
                    <table id="tableClients" class="display table table-striped table-bordered nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $c)
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->dni }}</td>
                                    <td>{{ $c->phone ?? '-' }}</td>
                                    <td>{{ $c->email ?? '-' }}</td>
                                    <td>
                                        <!-- Show -->
                                        <a href="{{ route('clients.show', $c) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <!-- Edit -->
                                        <button class="btn btn-sm btn-primary btn-edit-client" data-bs-toggle="modal"
                                            data-bs-target="#clientModalEdit" data-id="{{ $c->id }}"
                                            data-name="{{ $c->name }}" data-dni="{{ $c->dni }}"
                                            data-ruc="{{ $c->ruc }}" data-address="{{ $c->address }}"
                                            data-phone="{{ $c->phone }}" data-email="{{ $c->email }}"><i
                                                class="fa fa-edit"></i></button>
                                        <!-- Delete -->
                                        <form action="{{ route('clients.destroy', $c) }}" method="POST"
                                            style="display:inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Eliminar cliente?')">
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

@include('admin.client.create')
@include('admin.client.edit')

<!-- Scripts -->
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/plugins/dataTable.js') }}"></script>
<script src="{{ asset('assets/js/client.js') }}"></script>

@include('layouts.template.footer_admin')
