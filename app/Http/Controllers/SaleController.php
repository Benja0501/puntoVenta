<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::get();
        return view('admin.sale.index', compact('sales'));
    }

    public function create()
    {
        $clients = Client::get();
        $products = Product::all();
        return view('admin.sale.create', compact('clients', 'products'));
    }

    public function store(StoreSaleRequest $request)
    {
        // 1) Validar campos del formulario (client_id, tax, Arrays de product_id[], quantity[], price[], discount[])
        $data = $request->validated();
        // 1.1) Antes de seguir: revisamos stock para cada línea
        foreach ($request->product_id as $i => $prodId) {
            $qty = $request->quantity[$i] ?? 0;
            if ($qty <= 0) {
                // Si por alguna razón la cantidad es 0 o negativa, lo interpretamos como inválido
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['quantity.' . $i => 'La cantidad debe ser al menos 1.']);
            }

            // Obtenemos el producto
            $product = Product::find($prodId);
            if (!$product) {
                // Producto inexistente (validación extra de seguridad)
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['product_id.' . $i => 'El producto seleccionado no existe.']);
            }

            // Comprobamos stock
            if ($product->stock < $qty) {
                // No hay stock suficiente: devolvemos error indicando el nombre del producto y el stock disponible
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors([
                        'quantity.' . $i => "No hay stock suficiente para «{$product->name}». 
                        Stock disponible: {$product->stock}, se solicitó: {$qty}."
                    ]);
            }
        }
        // 2) Agregar user_id + fecha actual
        $data['user_id'] = auth()->id();
        $data['sale_date'] = now();

        // 3) Calcular subtotal línea a línea (respetando % de descuento) y total
        $subtotal = 0;
        foreach ($request->price as $i => $price) {
            $qty = $request->quantity[$i] ?? 0;
            $disc = $request->discount[$i] ?? 0; // porcentaje
            // subtotal de la línea aplicado el % de descuento:
            $lineSubtotal = ($price * $qty) * (1 - ($disc / 100));
            $subtotal += $lineSubtotal;
        }
        // impuesto sobre subtotal:
        $taxPct = $request->tax ?? 0;
        $taxAmt = $subtotal * ($taxPct / 100);
        $data['total'] = $subtotal + $taxAmt;

        // 4) Crear la cabecera de la venta
        $sale = Sale::create([
            'client_id' => $data['client_id'],
            'user_id' => $data['user_id'],
            'sale_date' => $data['sale_date'],
            'tax' => $data['tax'],
            'total' => $data['total'],
            // 'status' vendrá del $fillable o toma default 'VALID'
        ]);

        // 5) Insertar cada línea en sale_details
        $lines = [];
        foreach ($request->product_id as $i => $prodId) {
            $lines[] = [
                'product_id' => $prodId,
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
                'discount' => $request->discount[$i],
            ];
        }
        $sale->saleDetails()->createMany($lines);

        // 6) **ACTUALIZAR STOCK**: restamos la cantidad vendida de cada producto
        foreach ($request->product_id as $i => $prodId) {
            $qty = $request->quantity[$i] ?? 0;
            if ($qty > 0) {
                $product = Product::find($prodId);
                if ($product) {
                    $product->stock -= $qty;
                    // Como ya comprobamos que stock >= qty, no puede quedar en negativo
                    $product->save();
                }
            }
        }

        return redirect()
            ->route('sales.index')
            ->with('success', 'Venta registrada correctamente');
    }


    public function show(Sale $sale)
    {
        return view('admin.sale.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $clients = Client::get();
        return view('admin.sale.edit', compact('sale', 'clients'));
    }

    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    public function destroy(Sale $sale)
    {
        //
    }
}
