@include('layouts.template.header_admin')

{{-- Estilos específicos para impresión --}}
<style>
    /* 1) Antes que nada, indicamos que de la página SOLO queremos mostrar el área #print-area al imprimir */
    @media print {

        /* Ocultamos TODO el body… */
        body * {
            visibility: hidden !important;
        }

        /* … excepto #print-area y sus hijos */
        #print-area,
        #print-area * {
            visibility: visible !important;
        }

        /* Y forzamos que #print-area ocupe toda la hoja */
        #print-area {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            /* opcional: elimina márgenes extras si quieres que ocupe toda la página */
            margin: 0;
            padding: 0;
        }
    }

    /* 2) Adicionalmente, si tuvieras clases específicas para los botones,
          también puedes ocultarlas explícitamente en impresión */
    @media print {

        .btn,
        .btn-secondary,
        .btn-success {
            display: none !important;
        }
    }
</style>

<main class="app-main">
    <!-- Título + breadcrumbs -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <i class="fa-solid fa-receipt"></i>
                        Pedido
                        <small>Tienda JEMP</small>
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('purchases.index') }}">Compras</a></li>
                        <li class="breadcrumb-item active">Ver</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="app-content">
        <div class="container-fluid">

            {{-- Toda la tarjeta que queremos “recortar” para imprimir va dentro de este div con id="print-area" --}}
            <div id="print-area" class="card mb-4 p-4">
                <div class="row">
                    <!-- Logo / Tienda -->
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('dist/assets/img/logo_tienda.png') }}" alt="Logo" class="img-fluid mb-3"
                            style="max-width:120px;">
                        <p>
                            <strong>JEMP</strong><br>
                            Calle Falsa 123<br>
                            (+51) 900 000 000<br>
                            contacto@jemp.com
                        </p>
                    </div>

                    <!-- Usuario / Envío -->
                    <div class="col-md-3">
                        <h5>Usuario</h5>
                        <p>
                            <strong>{{ $purchase->user->name }}</strong><br>
                            Email: {{ $purchase->user->email }}<br>
                            {{-- Otros datos de envío si hubiera --}}
                        </p>
                    </div>

                    <!-- Datos de la Orden -->
                    <div class="col-md-6 text-end">
                        <h5>Orden #{{ $purchase->id }}</h5>
                        <p>
                            <strong>Fecha:</strong> {{ $purchase->purchase_date->format('d/m/Y') }}<br>
                            <strong>Proveedor:</strong> {{ $purchase->provider->name }}<br>
                            <strong>Impuesto:</strong> {{ number_format($purchase->tax, 2) }}%<br>
                            <strong>Total a Pagar:</strong> S/ {{ number_format($purchase->total, 2) }}
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
                                <th class="text-end">Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase->purchaseDetails as $line)
                                <tr>
                                    <td>{{ $line->product->name }}</td>
                                    <td class="text-end">S/ {{ number_format($line->price, 2) }}</td>
                                    <td class="text-end">{{ $line->quantity }}</td>
                                    <td class="text-end">
                                        S/ {{ number_format($line->price * $line->quantity, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            @php
                                $subtotal = $purchase->purchaseDetails->sum(fn($l) => $l->price * $l->quantity);
                                $taxAmt = $subtotal * ($purchase->tax / 100);
                            @endphp
                            <tr>
                                <th colspan="3" class="text-end">Sub-Total:</th>
                                <th class="text-end">S/ {{ number_format($subtotal, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Impuesto ({{ number_format($purchase->tax, 2) }}%):
                                </th>
                                <th class="text-end">S/ {{ number_format($taxAmt, 2) }}</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-end">Total a Pagar:</th>
                                <th class="text-end">S/ {{ number_format($purchase->total, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Botones de “Regresar” e “Imprimir” (ocultos en la impresión gracias al CSS anterior) -->
                <div class="text-end mt-4">
                    <a href="{{ route('purchases.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Regresar
                    </a>
                    <button onclick="window.print()" class="btn btn-success">
                        <i class="fa fa-print"></i> Imprimir
                    </button>
                </div>
            </div>
            {{-- /print-area --}}

        </div>
    </div>
</main>

@include('layouts.template.footer_admin')
