<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        // Traemos los productos con su categoría y proveedor
        $products = Product::with(['category', 'provider'])->get();
        // Además traemos todas las categorías y proveedores
        $categories = Category::all();
        $providers = Provider::all();

        // Ahora la vista admin.product.index tendrá disponibles:
        // $products, $categories, $providers
        return view('admin.product.index', compact('products', 'categories', 'providers'));
    }

    public function create()
    {
        $categories = Category::get();
        $providers = Provider::get();
        return view('admin.product.create', compact('categories', 'providers'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Asegúrate de que existe public/assets/images
            $imagesPath = public_path('assets/images');
            if (!File::exists($imagesPath)) {
                File::makeDirectory($imagesPath, 0755, true);
            }

            $img = $request->file('image');
            $name = time() . '.' . $img->getClientOriginalExtension();
            $img->move($imagesPath, $name);

            // Guardamos la ruta relativa
            $data['image'] = 'assets/images/' . $name;
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado correctamente');

    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::get();
        $providers = Provider::get();
        return view('admin.product.edit', compact('product', 'categories', 'providers'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Borra la anterior si existe
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $imagesPath = public_path('assets/images');
            if (!File::exists($imagesPath)) {
                File::makeDirectory($imagesPath, 0755, true);
            }

            $img = $request->file('image');
            $name = time() . '.' . $img->getClientOriginalExtension();
            $img->move($imagesPath, $name);

            $data['image'] = 'assets/images/' . $name;
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
