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
                        <i class="fa-solid fa-box-tissue"></i>
                        Categorías
                        <small>Tienda JEMP</small>
                        <button id="btnNuevo" type="button" class="btn btn-secondary mb-2"><i
                                class="fa-solid fa-plus"></i> Nuevo</button>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categorías</li>
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

                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-sm-6">
                                        <h4 class="mb-0">
                                            Categorías
                                            </h>
                                    </div>
                                    <table id="tableCategorias"
                                        class="display table table-striped table-bordered nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Fecha de Creación</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->description}}</td>
                                                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#categoryModalEdit"
                                                            data-id="{{ $category->id }}"
                                                            data-name="{{ $category->name }}"
                                                            data-description="{{ $category->description }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>


                                                        <form action="{{ route('categories.destroy', $category) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-danger"
                                                                onclick="return confirm('¿Eliminar categoría?')">
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
                            <!--end::Row-->
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
<!-- DataTables core JS -->
@include('admin.category.create')
@include('admin.category.edit')


<!-- Tu script específico de categorías -->
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<!-- Bootstrap 5 bundle (Popper + JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/js/plugins/dataTable.js') }}"></script>

<script src="{{ asset('assets/js/category.js') }}"></script>

@include('layouts.template.footer_admin')
