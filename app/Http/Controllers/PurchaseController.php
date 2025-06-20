<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetails; // o PurchaseDetail si usas singular
use App\Models\Provider;
use App\Models\Product;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use PDF;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['provider', 'user'])->get();
        $providers = Provider::all();
        return view('admin.purchase.index', compact('purchases', 'providers'));
    }

    public function create()
    {
        $providers = Provider::all();
        $products = Product::all();
        return view('admin.purchase.create', compact('providers', 'products'));
    }

    public function store(StorePurchaseRequest $request)
    {
        // 1) Validamos solo los campos que vienen por formulario
        $data = $request->validated();

        // 2) Añadimos user_id y fecha de compra
        $data['user_id'] = auth()->id();
        $data['purchase_date'] = now();

        // 3) Calculamos el subtotal (suma de price * quantity)
        $subtotal = 0;
        foreach ($request->price as $i => $price) {
            $qty = $request->quantity[$i] ?? 0;
            $subtotal += $price * $qty;
        }
        // 4) Calculamos el total a pagar = subtotal + impuesto
        $taxPct = $data['tax'] / 100;           // ej. 18 → 0.18
        $taxAmount = $subtotal * $taxPct;          // monto de impuesto
        $grandTotal = $subtotal + $taxAmount;       // total con impuesto
        $data['total'] = $grandTotal;

        // 5) Creamos la cabecera de la compra
        $purchase = Purchase::create($data);

        // 6) Insertamos las líneas en purchase_details
        foreach ($request->product_id as $i => $prodId) {
            PurchaseDetails::create([
                'shopping_id' => $purchase->id,
                'product_id' => $prodId,
                'quantity' => $request->quantity[$i],
                'price' => $request->price[$i],
            ]);
        }
        // 7) Aquí es donde actualizaremos el stock de cada producto
        //    (recorremos nuevamente los product_id y quantity para sumarlos al stock actual)
        foreach ($request->product_id as $i => $prodId) {
            $qty = $request->quantity[$i] ?? 0;
            if ($qty > 0) {
                $product = Product::find($prodId);
                if ($product) {
                    $product->stock += $qty;
                    $product->save();
                }
            }
        }
        return redirect()
            ->route('purchases.index')
            ->with('success', 'Compra registrada correctamente');
    }

    public function show(Purchase $purchase)
    {
        // Cargamos proveedor, usuario y detalles + sus productos de golpe
        $purchase->load(['provider', 'user', 'purchaseDetails.product']);
        return view('admin.purchase.show', compact('purchase'));
    }


    public function edit(Purchase $purchase)
    {
        $providers = Provider::all();
        return view('admin.purchase.edit', compact('purchase', 'providers'));
    }

    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        // …
    }

    public function destroy(Purchase $purchase)
    {
        // …
    }
    public function pdf(Purchase $purchase)
    {
        $purchase->load(['provider', 'user', 'purchaseDetails.product']);
        $pdf = \PDF::loadView('admin.purchase.pdf', ['purchase' => $purchase]);
        $filename = 'compra_' . str_pad($purchase->id, 4, '0', STR_PAD_LEFT) . '.pdf';
        return $pdf->download($filename);
    }

}
