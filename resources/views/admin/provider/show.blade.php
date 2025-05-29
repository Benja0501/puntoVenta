@include('layouts.template.header_admin')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><i class="fa-solid fa-truck"></i> Detalles del proveedor - <small>Tienda
                            JEMP</small></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('providers.index') }}">Proveedores</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Menú lateral -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="card-title">{{ $provider->name }}</h3>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item active">Sobre proveedor</li>
                            <li class="list-group-item">Productos</li>
                            <li class="list-group-item">Registrar producto</li>
                        </ul>
                    </div>
                </div>

                <!-- Detalles -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Información de proveedor</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <p><strong><i class="fa fa-user"></i> Nombre:</strong> {{ $provider->name }}</p>
                                    <p><strong><i class="fa fa-id-card"></i> Número de RUC:</strong>
                                        {{ $provider->ruc_number }}</p>
                                    <p><strong><i class="fa fa-envelope"></i> Correo:</strong> {{ $provider->email }}
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p><strong><i class="fa fa-phone"></i> Teléfono:</strong> {{ $provider->phone }}</p>
                                    <p><strong><i class="fa fa-map-marker-alt"></i> Dirección:</strong>
                                        {{ $provider->address ?? '-' }}</p>
                                    <p><strong><i class="fa fa-calendar"></i> Fecha de creación:</strong>
                                        {{ $provider->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Botón regresar alineado a la derecha -->
                    <div class="mt-3 text-end">
                        <a href="{{ route('providers.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Regresar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>

@include('layouts.template.footer_admin')
