{{-- resources/views/admin/sale/show.blade.php --}}
@include('layouts.template.header_admin')

{{-- Estilos específicos para impresión --}}
<style>
    @media print {
        /* 1) Ocultar por completo TODO en <body> */
        body * {
            visibility: hidden !important;
        }
        /* 2) Hacer visible SOLO el contenedor .boleta-container y sus hijos */
        .boleta-container, 
        .boleta-container * {
            visibility: visible !important;
        }
        /* 3) Posicionar .boleta-container al tope para que ocupe toda la página */
        .boleta-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        /* 4) Eliminar márgenes/padding del body en impresión */
        body {
            margin: 0 !important;
            padding: 0 !important;
        }
        .no-print{
            display: none !important; /* Ocultar elementos que no queremos imprimir */
        }
    }
</style>

<main class="app-main">
    {{-- Esta cabecera NO se imprimirá (porque usamos visibility:hidden para todo) --}}
    <div class="app-content-header no-print">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-cash-register"></i>
                        Venta
                        <small>Tienda JEMP</small>
                    </h3>
                </div>
                <div class="col-sm-6 text-end">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Ventas</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Contenedor principal que SÍ queremos imprimir --}}
    <div class="app-content boleta-container">
        <div class="container-fluid">
            <div class="card mb-4 p-4">
                <div class="row">
                    {{-- Logo / Datos Tienda --}}
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('assets/img/logo_tienda.png') }}"
                             alt="Logo" class="img-fluid mb-3" style="max-width:120px;">
                        <p>
                            <strong>JEMP</strong><br>
                            Calle Falsa 123<br>
                            (+51) 900 000 000<br>
                            contacto@jemp.com
                        </p>
                    </div>

                    {{-- Datos del Cliente --}}
                    <div class="col-md-3">
                        <h5>Cliente</h5>
                        <p>
                            <strong>{{ $sale->client->name }}</strong><br>
                            {{ $sale->client->email ?? '' }}<br>
                            {{ $sale->client->phone ?? '' }}
                        </p>
                    </div>

                    {{-- Datos de la Venta --}}
                    <div class="col-md-6 text-end">
                        <h5>Venta #{{ $sale->id }}</h5>
                        <p>
                            <strong>Fecha:</strong> {{ $sale->sale_date->format('d/m/Y H:i') }}<br>
                            <strong>Atendido por:</strong> {{ $sale->user->name }}<br>
                            <strong>Estado:</strong> {{ $sale->status }}<br>
                            <strong>Total:</strong> S/ {{ number_format($sale->total, 2) }}
                        </p>
                    </div>
                </div>

                <hr>

                {{-- Tabla de Detalles --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Descripción</th>
                                <th class="text-end">Precio (S/)</th>
                                <th class="text-end">Cantidad</th>
                                <th class="text-end">Descuento (%)</th>
                                <th class="text-end">Importe (S/)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->saleDetails as $detail)
                                @php
                                    $precio      = $detail->price;
                                    $qty         = $detail->quantity;
                                    $disc        = $detail->discount;
                                    $lineImporte = $precio * $qty * (1 - $disc / 100);
                                @endphp
                                <tr>
                                    <td>{{ $detail->product->name }}</td>
                                    <td class="text-end">{{ number_format($precio, 2) }}</td>
                                    <td class="text-end">{{ $qty }}</td>
                                    <td class="text-end">{{ number_format($disc, 2) }}</td>
                                    <td class="text-end">{{ number_format($lineImporte, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            @php
                                $subtotal = $sale->saleDetails->sum(function ($d) {
                                    return $d->price * $d->quantity * (1 - $d->discount / 100);
                                });
                                $taxPct = $sale->tax;
                                $taxAmt = $subtotal * ($taxPct / 100);
                                $total  = $subtotal + $taxAmt;
                            @endphp
                            <tr>
                                <th colspan="4" class="text-end">Sub-Total:</th>
                                <th class="text-end">S/ {{ number_format($subtotal, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">Impuesto ({{ number_format($taxPct, 2) }}%):</th>
                                <th class="text-end">S/ {{ number_format($taxAmt, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end">Total a Pagar:</th>
                                <th class="text-end">S/ {{ number_format($total, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                {{-- Botones que NO se imprimirán (porque usamos visibility:hidden sobre todo excepto .boleta-container) --}}
                <div class="text-end mt-3 no-print">
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Regresar
                    </a>
                    <button onclick="window.print()" class="btn btn-success">
                        <i class="fa fa-print"></i> Imprimir Boleta
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.template.footer_admin')
