<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WasteCategory;
use App\Http\Requests\StoreWasteCategoryRequest;
use App\Http\Requests\UpdateWasteCategoryRequest;

class WasteCategoryController extends Controller
{
    public function index()
    {
        $categories = WasteCategory::when(request('search'), function($q) {
            $search = request('search');
            $q->where('name', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();
        return view('waste_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('waste_categories.create');
    }

    public function store(StoreWasteCategoryRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');
        
        WasteCategory::create($validated);
        return redirect()->route('waste-categories.index')->with('success', 'Kategori Sampah berhasil ditambahkan.');
    }

    public function edit(WasteCategory $wasteCategory)
    {
        return view('waste_categories.edit', compact('wasteCategory'));
    }

    public function update(UpdateWasteCategoryRequest $request, WasteCategory $wasteCategory)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active') ? $request->is_active : false;
        
        $wasteCategory->update($validated);
        return redirect()->route('waste-categories.index')->with('success', 'Kategori Sampah berhasil diperbarui.');
    }

    public function destroy(WasteCategory $wasteCategory)
    {
        // Check if category is used in purchases
        if ($wasteCategory->wastePurchaseItems()->count() > 0) {
            return redirect()->route('waste-categories.index')->with('error', 'Kategori tidak bisa dihapus karena telah digunakan pada transaksi pembelian.');
        }
        
        $wasteCategory->delete();
        return redirect()->route('waste-categories.index')->with('success', 'Kategori Sampah berhasil dihapus.');
    }
}
