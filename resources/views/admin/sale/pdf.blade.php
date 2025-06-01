{{-- resources/views/admin/sale/pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Venta #{{ $sale->id }}</title>
    <style>
        /* Acá puedes pegar el CSS mínimo que usabas en el PDF de compra.
           Por simplicidad, incluimos estilos básicos inline. */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 1rem;
        }
        .header img {
            max-width: 100px;
            margin-bottom: .5rem;
        }
        .info {
            width: 100%;
            margin-bottom: 1rem;
        }
        .info .left, .info .right {
            display: inline-block;
            vertical-align: top;
        }
        .info .left {
            width: 40%;
        }
        .info .right {
            width: 58%;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table, th, td {
            border: 1px solid #aaa;
        }
        th, td {
            padding: .5rem;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .totals td {
            border: none;
        }
        .totals .label {
            text-align: right;
            padding-right: 1rem;
        }
    </style>
</head>
<body>
    <div class="header">
        {{-- Si incluyes un logo, asegúrate de usar la ruta absoluta o base64 --}}
        <img src="{{ public_path('dist/assets/img/logo_tienda.png') }}" alt="Logo JEMP">
        <h2>JEMP</h2>
        <div>Calle Falsa 123 · (+51) 900 000 000 · contacto@jemp.com</div>
    </div>

    <div class="info">
        <div class="left">
            <strong>Cliente:</strong><br>
            {{ $sale->client->name }}<br>
            {{ $sale->client->email ?? '' }} {{-- Si guardaste email del cliente --}}
            {{-- Agrega aquí más datos del cliente si quieres --}}
        </div>
        <div class="right">
            <strong>Venta #{{ $sale->id }}</strong><br>
            <strong>Fecha:</strong> {{ $sale->sale_date->format('d/m/Y H:i') }}<br>
            <strong>Atendido por:</strong> {{ $sale->user->name }}<br>
            <strong>Estado:</strong> {{ $sale->status }}<br>
            <strong>Total:</strong> S/ {{ number_format($sale->total, 2) }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th class="text-right">Precio (S/)</th>
                <th class="text-right">Cantidad</th>
                <th class="text-right">Descuento (%)</th>
                <th class="text-right">Importe (S/)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleDetails as $detail)
                @php
                    $precio = $detail->price;
                    $qty   = $detail->quantity;
                    $disc  = $detail->discount;
                    // Cada línea con descuento porcentual:
                    $lineImporte = ($precio * $qty) * (1 - ($disc/100));
                @endphp
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td class="text-right">{{ number_format($precio, 2) }}</td>
                    <td class="text-right">{{ $qty }}</td>
                    <td class="text-right">{{ number_format($disc, 2) }}</td>
                    <td class="text-right">{{ number_format($lineImporte, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                // Recalculamos subtotal y total de impuestos (por si quieres detallarlo aquí):
                $subtotal = $sale->saleDetails->sum(function($d){
                    return ($d->price * $d->quantity) * (1 - ($d->discount/100));
                });
                $taxPct   = $sale->tax;
                $taxAmt   = $subtotal * ($taxPct/100);
                $total    = $subtotal + $taxAmt;
            @endphp
            <tr class="totals">
                <td colspan="4" class="label"><strong>Sub-Total:</strong></td>
                <td class="text-right"><strong>S/ {{ number_format($subtotal, 2) }}</strong></td>
            </tr>
            <tr class="totals">
                <td colspan="4" class="label"><strong>Impuesto ({{ number_format($taxPct,2) }}%):</strong></td>
                <td class="text-right"><strong>S/ {{ number_format($taxAmt, 2) }}</strong></td>
            </tr>
            <tr class="totals">
                <td colspan="4" class="label"><strong>Total a Pagar:</strong></td>
                <td class="text-right"><strong>S/ {{ number_format($total, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
