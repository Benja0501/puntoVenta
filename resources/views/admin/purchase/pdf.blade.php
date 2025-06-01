{{-- resources/views/admin/purchase/pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Compra #{{ $purchase->id }}</title>
    <style>
        /* Ejemplo básico de estilos inline; puedes ajustarlo a tus necesidades */
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .shop-info {
            font-weight: bold;
        }

        .client-info,
        .order-info {
            margin-top: 20px;
        }

        .client-info,
        .order-info,
        .shop-info {
            width: 100%;
            display: inline-block;
        }

        .client-info p,
        .order-info p,
        .shop-info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        table th,
        table td {
            border: 1px solid #444;
            padding: 4px;
            text-align: left;
        }

        table th {
            background-color: #eee;
        }

        tfoot tr th,
        tfoot tr td {
            border: none;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>

    <header>
        <img src="{{ public_path('dist/assets/img/logo_tienda.png') }}" class="logo" alt="Logo JEMP">
        <div class="shop-info">
            <p>JEMP</p>
            <p>Calle Falsa 123</p>
            <p>(+51) 900 000 000</p>
            <p>contacto@jemp.com</p>
        </div>
    </header>

    <section class="client-info">
        <h4>Datos del Proveedor</h4>
        <p><strong>Nombre:</strong> {{ $purchase->provider->name }}
            <!-- o $purchase->user->name si fuera cliente interno --></p>
        <p><strong>Email:</strong> {{ $purchase->provider->email ?? '---' }}</p>
        {{-- Si tu Purchase tuviera campos de shipping, agrégalos aquí --}}
    </section>

    <section class="order-info">
        <h4>Datos de la Orden</h4>
        <p><strong>Orden #:</strong> {{ $purchase->id }}</p>
        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d/m/Y H:i') }}</p>
        <p><strong>Estado:</strong> {{ $purchase->status }}</p>
        <p><strong>Total:</strong> S/ {{ number_format($purchase->total, 2) }}</p>
    </section>

    {{-- Tabla de detalles --}}
    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th class="text-right">Precio</th>
                <th class="text-right">Cantidad</th>
                <th class="text-right">Importe</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
                $taxPct = $purchase->tax;
            @endphp

            @foreach ($purchase->purchaseDetails as $line)
                @php
                    $lineImporte = $line->price * $line->quantity;
                    $subtotal += $lineImporte;
                @endphp
                <tr>
                    <td>{{ $line->product->name }}</td>
                    <td class="text-right">S/ {{ number_format($line->price, 2) }}</td>
                    <td class="text-right">{{ $line->quantity }}</td>
                    <td class="text-right">S/ {{ number_format($lineImporte, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                $taxAmount = $subtotal * ($taxPct / 100);
                $total = $subtotal + $taxAmount;
            @endphp
            <tr>
                <th colspan="3" class="text-right">Sub-Total:</th>
                <td class="text-right">S/ {{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Impuesto ({{ number_format($taxPct, 2) }}%):</th>
                <td class="text-right">S/ {{ number_format($taxAmount, 2) }}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Total a Pagar:</th>
                <td class="text-right">S/ {{ number_format($total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    {{-- Pie de página con fecha/hora de impresión --}}
    <footer style="position: absolute; bottom: 10px; width: 100%; text-align: center; font-size: 10px;">
        <p>Documento generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </footer>

</body>

</html>
