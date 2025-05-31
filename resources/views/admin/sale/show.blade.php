{{-- resources/views/admin/sale/show.blade.php --}}
@include('layouts.template.header_admin')

<main class="app-main">
    <!-- Título + breadcrumbs -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-receipt"></i>
                        Venta
                        <small>JEMP</small>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card mb-4 p-4">
                <div class="row">
                    <!-- Logo / Tienda -->
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('dist/assets/img/logo_tienda.png') }}" alt="Logo" class="img-fluid mb-3"
                            style="max-width:120px;">
                        <p><strong>JEMP</strong><br>
                            Calle Falsa 123<br>
                            (+51) 900 000 000<br>
                            contacto@jemp.com
                        </p>
                    </div>

                    <!-- Cliente -->
                    <div class="col-md-3">
                        <h5>Cliente</h5>
                        <p>
                            <strong>{{ $sale->client->name }}</strong><br>
                            Email: {{ $sale->client->email }}<br>
                            {{-- Pon aquí más datos del cliente si los tuvieras --}}
                        </p>
                    </div>

                    <!-- Datos de la Venta -->
                    <div class="col-md-6 text-end">
                        <h5>Orden #{{ $sale->id }}</h5>
                        <p>
                            <strong>Fecha:</strong> {{ $sale->sale_date->format('d/m/Y H:i') }}<br>
                            <strong>Vendedor:</strong> {{ $sale->user->name }}<br>
                            <strong>Impuesto:</strong> {{ number_format($sale->tax, 2) }}%<br>
                            <strong>Total a Pagar:</strong> S/ {{ number_format($sale->total, 2) }}
                        </p>
                    </div>
                </div>

                <hr>

                <!-- Tabla de líneas -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Descripción</th>
                                <th class="text-end">Precio</th>
                                <th class="text-end">Cantidad</th>
                                <th class="text-end">Descuento %</th>
                                <th class="text-end">Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleDetails as $line)
                                <tr>
                                    <td>{{ $line->product->name }}</td>
                                    <td class="text-end">S/ {{ number_format($line->price, 2) }}</td>
                                    <td class="text-end">{{ $line->quantity }}</td>
                                    <td class="text-end">{{ number_format($line->discount, 2) }} %</td>
                                    <td class="text-end">
                                        @php
                                            $lineAmount = $line->price * $line->quantity - $line->discount;
                                        @endphp
                                        S/ {{ number_format($lineAmount, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            @php
                                $subtotal = $sale->saleDetails->sum(function ($l) {
                                    return $l->price * $l->quantity - $l->discount;
                                });
                                $taxAmt = $subtotal * ($sale->tax / 100);
                            @endphp
                            <tr>
                                <th colspan="4" class="text-end">Sub-Total:</th>
                                <th class="text-end">S/ {{ number_format($subtotal, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">Impuesto ({{ number_format($sale->tax, 2) }}%):</th>
                                <th class="text-end">S/ {{ number_format($taxAmt, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">Total a Pagar:</th>
                                <th class="text-end">S/ {{ number_format($sale->total, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Botones -->
                <div class="text-end">
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Regresar
                    </a>
                    <button onclick="window.print()" class="btn btn-success">
                        <i class="fa fa-print"></i> Imprimir
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.template.footer_admin')
