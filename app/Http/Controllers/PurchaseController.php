<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Provider;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::get();
        return view('admin.purchase.index', compact('purchases'));
    }

    public function create()
    {
        $providers = Provider::get();
        return view('admin.purchase.create', compact('providers'));
    }

    public function store(StorePurchaseRequest $request)
    {
        $purchase = Purchase::create($request->all());

        foreach ($request->product_id as $key => $product) {
            $results[] = array("product_id" => $request->product_id[$key], 
            "quantity" => $request->quantity[$key], "price" => $request->price[$key]);
        }
        $purchase->purchaseDetails()->createMany($results);

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully');
    }

    public function show(Purchase $purchase)
    {
        return view('admin.purchase.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $providers = Provider::get();
        return view('admin.purchase.edit', compact('purchase', 'providers'));
    }

    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        // $purchase->update($request->all());
        // return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully');
    }

    public function destroy(Purchase $purchase)
    {
        // $purchase->delete();
        // return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully');
    }
}
