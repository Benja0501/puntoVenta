@include('layouts.template.header_admin')

<main class="app-main">
    <!-- Cabecera de contenido -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <!-- Título y breadcrumbs -->
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-box"></i>
                        Detalles del producto
                        <small>Tienda JEMP</small>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Panel lateral (imagen + resumen) -->
                <div class="col-md-3">
                    <div class="card mb-4">
                        <img src="{{ asset($product->image) }}" class="card-img-top"
                            alt="Imagen de {{ $product->name }}">
                        <div class="card-body text-center">
                            <h4 class="card-title">{{ $product->name }}</h4>
                        </div>
                        <ul class="list-group list-group-flush text-sm">
                            <li class="list-group-item"><strong>Estado:</strong> {{ $product->status }}</li>
                            <li class="list-group-item"><strong>Proveedor:</strong> <a
                                    href="{{ route('providers.show', $product->provider) }}"
                                    class="text-decoration-none">
                                    {{ $product->provider->name }}
                                </a></li>
                            <li class="list-group-item"><strong>Categoría:</strong> {{ $product->category->name }}</li>
                        </ul>
                        <div class="card-body text-center">
                            <span
                                class="badge 
         {{ $product->status === 'ACTIVE' ? 'bg-success' : 'bg-danger' }} 
         px-4 py-2 text-uppercase">
                                {{ $product->status }}
                            </span>

                        </div>
                    </div>
                </div>

                <!-- Información detallada -->
                <div class="col-md-9">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Información de producto</h5>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-sm-6">
                                    <p><strong><i class="fa fa-hashtag"></i> Código:</strong> {{ $product->code }}</p>
                                    <p><strong><i class="fa fa-tag"></i> Nombre:</strong> {{ $product->name }}</p>
                                    <p><strong><i class="fa fa-boxes"></i> Stock:</strong> {{ $product->stock }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><strong><i class="fa fa-dollar-sign"></i> Precio de venta:</strong>
                                        {{ number_format($product->sell_price, 2) }}</p>
                                    <p><strong><i class="fa fa-calendar"></i> Creado:</strong>
                                        {{ $product->created_at->format('d/m/Y H:i') }}</p>
                                    <p><strong><i class="fa fa-calendar-alt"></i> Actualizado:</strong>
                                        {{ $product->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Botón regresar -->
                    <div class="text-end">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Regresar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.template.footer_admin')
