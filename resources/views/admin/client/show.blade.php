{{-- resources/views/admin/client/show.blade.php --}}
@include('layouts.template.header_admin')

<main class="app-main">
    <!-- Cabecera -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <!-- Título y breadcrumbs -->
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-user-tag"></i>
                        {{ $client->name }}
                        <small>Tienda JEMP</small>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clientes</a></li>
                        <li class="breadcrumb-item active">{{ $client->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Panel lateral -->
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h4 class="card-title">{{ $client->name }}</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item active">Sobre cliente</li>
                            <li class="list-group-item">
                                <a href="#" class="text-decoration-none">Historial de compras</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Información detallada -->
                <div class="col-md-9">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Información de cliente</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Columna izquierda -->
                                <div class="col-sm-6">
                                    <p><strong><i class="fa fa-user"></i> Nombre:</strong> {{ $client->name }}</p>
                                    <p><strong><i class="fa fa-id-card"></i> Número de DNI:</strong> {{ $client->dni }}
                                    </p>
                                    <p><strong><i class="fa fa-id-badge"></i> Número de RUC:</strong>
                                        {{ $client->ruc ?? '-' }}</p>
                                </div>
                                <!-- Columna derecha -->
                                <div class="col-sm-6">
                                    <p><strong><i class="fa fa-map-marker-alt"></i> Dirección:</strong>
                                        {{ $client->address ?? '-' }}</p>
                                    <p><strong><i class="fa fa-phone"></i> Teléfono / Celular:</strong>
                                        {{ $client->phone ?? '-' }}</p>
                                    <p><strong><i class="fa fa-envelope"></i> Correo electrónico:</strong>
                                        {{ $client->email ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Botón regresar -->
                    <div class="text-end">
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.template.footer_admin')
