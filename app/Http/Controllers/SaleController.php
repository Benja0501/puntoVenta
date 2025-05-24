<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    public function index()
    {
        $sale = Sale::get();
        return view('admin.sale.index', compact('sale'));
    }

    public function create()
    {
        $clients = Client::get();
        return view('admin.sale.create', compact('clients'));   
    }

    public function store(StoreSaleRequest $request)
    {
        $sale = Sale::create($request->all());

        foreach ($request->product_id as $key => $product) {
            $results[] = array("product_id" => $request->product_id[$key], 
            "quantity" => $request->quantity[$key], "price" => $request->price[$key],
            "discount" => $request->discount[$key]);
        }
        $sale->saleDetails()->createMany($results);

        return redirect()->route('sales.index')->with('success', 'Sale created successfully');
    }

    public function show(Sale $sale)
    {
        return view('admin.sale.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $clients = Client::get();
        return view('admin.sale.show', compact('sale', 'clients'));
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
