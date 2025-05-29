@include('layouts.template.header_admin')
<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-truck"></i>
                        Proveedores
                        <small>Tienda JEMP</small>
                        <button id="btnNuevoProvider" type="button" class="btn btn-secondary mb-2">
                            <i class="fa-solid fa-plus"></i> Nuevo
                        </button>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Proveedores</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="tableProviders" class="display table table-striped table-bordered nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>RUC</th>
                                        {{-- <th>Dirección</th> --}}
                                        <th>Teléfono</th>
                                        {{-- <th>Fecha de Creación</th> --}}
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($providers as $provider)
                                        <tr>
                                            <td>{{ $provider->id }}</td>
                                            <td>{{ $provider->name }}</td>
                                            <td>{{ $provider->email }}</td>
                                            <td>{{ $provider->ruc_number }}</td>
                                            {{-- <td>{{ $provider->address ?? '-' }}</td> --}}
                                            <td>{{ $provider->phone }}</td>
                                            {{-- <td>{{ $provider->created_at->format('Y-m-d') }}</td> --}}
                                            <td>
                                                <a href="{{ route('providers.show', $provider) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <!-- Botón Editar -->
                                                <button type="button" class="btn btn-sm btn-primary btn-edit-provider"
                                                    data-bs-toggle="modal" data-bs-target="#providerModalEdit"
                                                    data-id="{{ $provider->id }}" data-name="{{ $provider->name }}"
                                                    data-email="{{ $provider->email }}"
                                                    data-ruc="{{ $provider->ruc_number }}"
                                                    data-address="{{ $provider->address }}"
                                                    data-phone="{{ $provider->phone }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <!-- Form eliminar -->
                                                <form action="{{ route('providers.destroy', $provider) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Eliminar proveedor?')">
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
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->

@include('admin.provider.create')
@include('admin.provider.edit')

<!-- Scripts -->
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/js/plugins/dataTable.js') }}"></script>
<script src="{{ asset('assets/js/provider.js') }}"></script>

@include('layouts.template.footer_admin')
