<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InventoryTransaction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class InventoryTransactionController extends Controller
{
    public function index()
    {
        $transactions = InventoryTransaction::with(['product', 'user'])
            ->when(request('search'), function($q) {
                $search = request('search');
                $q->where('notes', 'like', "%{$search}%")
                  ->orWhereHas('product', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            })
            ->latest()->paginate(10)->withQueryString();
        return view('inventory.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->get();
        return view('inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out,adjustment',
            'quantity' => 'required|numeric|min:0',
            'notes' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($validated['product_id']);
            $stockBefore = $product->stock;
            $stockAfter = $stockBefore;
            $quantity = $validated['quantity'];

            if ($validated['type'] === 'in') {
                $stockAfter = $stockBefore + $quantity;
            } elseif ($validated['type'] === 'out') {
                if ($stockBefore < $quantity) {
                    return back()->withInput()->with('error', 'Stok tidak mencukupi untuk dikeluarkan.');
                }
                $stockAfter = $stockBefore - $quantity;
            } else {
                // Adjustment
                $stockAfter = $quantity; // quantity becomes the absolute new stock
                $quantity = abs($stockAfter - $stockBefore); // Calculate diff just for recording
                
                // Redefine type based on difference for recording purposes if needed, 
                // but we can just leave it as 'adjustment'
            }

            // Record transaction
            InventoryTransaction::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => $validated['type'],
                'quantity' => $validated['quantity'], // original input
                'stock_before' => $stockBefore,
                'stock_after' => $stockAfter,
                'notes' => $validated['notes'],
            ]);

            // Update Product stock
            $product->update(['stock' => $stockAfter]);

            DB::commit();
            return redirect()->route('inventory.index')->with('success', 'Penyesuaian stok berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
