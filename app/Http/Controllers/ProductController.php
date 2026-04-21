<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::when(request('search'), function($q) {
            $search = request('search');
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');
        $validated['stock'] = 0; // Initial stock is always 0
        
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active') ? $request->is_active : false;
        
        // Don't allow updating SKU if we want to be strict, but we've disabled it in UI
        if(isset($validated['sku'])) {
            unset($validated['sku']);
        }
        
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->saleItems()->count() > 0 || $product->inventoryTransactions()->count() > 0) {
            return redirect()->route('products.index')->with('error', 'Produk tidak bisa dihapus karena memiliki riwayat transaksi penjualan atau inventori.');
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
