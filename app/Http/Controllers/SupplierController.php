<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::when(request('search'), function($q) {
            $search = request('search');
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('contact_person', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        // Check if supplier has purchases before deleting
        if ($supplier->wastePurchases()->count() > 0) {
            return redirect()->route('suppliers.index')->with('error', 'Supplier tidak bisa dihapus karena memiliki riwayat pembelian.');
        }
        
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
