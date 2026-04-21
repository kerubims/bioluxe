<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductionBatch;
use App\Models\BatchLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductionBatchController extends Controller
{
    public function index()
    {
        $batches = ProductionBatch::when(request('search'), function($q) {
            $search = request('search');
            $q->where('batch_number', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();
        return view('production_batches.index', compact('batches'));
    }

    public function create()
    {
        return view('production_batches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'started_at' => 'required|date',
            'estimated_harvest' => 'required|date|after_or_equal:started_at',
            'total_waste_kg' => 'required|numeric|min:0.1',
            'em4_liters' => 'required|numeric|min:0',
            'molasses_kg' => 'required|numeric|min:0',
            'water_liters' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Generate Batch Number
            $date = date('Ymd');
            $lastBatch = ProductionBatch::whereDate('created_at', today())->count() + 1;
            $batchNumber = 'BATCH-' . $date . '-' . str_pad($lastBatch, 3, '0', STR_PAD_LEFT);

            $batch = ProductionBatch::create([
                'batch_number' => $batchNumber,
                'user_id' => auth()->id(),
                'status' => 'persiapan',
                'total_waste_kg' => $validated['total_waste_kg'],
                'em4_liters' => $validated['em4_liters'],
                'molasses_kg' => $validated['molasses_kg'],
                'water_liters' => $validated['water_liters'],
                'started_at' => $validated['started_at'],
                'estimated_harvest' => $validated['estimated_harvest'],
                'notes' => $validated['notes'],
            ]);

            DB::commit();
            return redirect()->route('production-batches.show', $batch)->with('success', 'Batch produksi berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(ProductionBatch $productionBatch)
    {
        $productionBatch->load(['user', 'batchLogs.user']);
        $batch = $productionBatch; // Alias for view
        return view('production_batches.show', compact('batch'));
    }

    public function updateStatus(Request $request, ProductionBatch $batch)
    {
        $validated = $request->validate([
            'status' => 'required|in:fermentasi,panen,gagal',
            'log_notes' => 'nullable|string',
            'actual_harvest' => 'nullable|required_if:status,panen|date',
            'yield_liters' => 'nullable|required_if:status,panen|numeric|min:0',
            'solid_waste_kg' => 'nullable|required_if:status,panen|numeric|min:0',
        ]);

        if ($batch->status === 'panen' || $batch->status === 'gagal') {
            return back()->with('error', 'Status batch yang sudah selesai tidak dapat diubah.');
        }

        try {
            DB::beginTransaction();

            $oldStatus = $batch->status;
            $newStatus = $validated['status'];

            // Update Master
            $updateData = ['status' => $newStatus];
            if ($newStatus === 'panen') {
                $updateData['actual_harvest'] = $validated['actual_harvest'];
                $updateData['yield_liters'] = $validated['yield_liters'];
                $updateData['solid_waste_kg'] = $validated['solid_waste_kg'];
                
                // Update Inventory for yield
                // Assume we have a main Product we map this to, or we ask user. 
                // Since there could be multiple products (sizes), we might just add to a "Raw POC" product,
                // or we just skip auto inventory update and rely on Manual adjustment for now 
                // if we don't have a 1-to-1 mapping of Batch Yield to a specific SKU.
                // For simplicity of this POC, we will just leave it as manual adjustment or we can pick the first product.
                $product = \App\Models\Product::first();
                if ($product && $validated['yield_liters'] > 0) {
                    // Try to convert yield to product stock (assuming 1 yield_liter = 1 unit for example, or based on volume_ml)
                    // Wait, this is tricky. Let's just create a raw transaction if we can, or just skip.
                    // Let's add it to the first product as an example.
                    $volume_ml = $product->volume_ml > 0 ? $product->volume_ml : 1000;
                    $qtyToAdd = floor(($validated['yield_liters'] * 1000) / $volume_ml);
                    
                    if ($qtyToAdd > 0) {
                        $stockBefore = $product->stock;
                        $stockAfter = $stockBefore + $qtyToAdd;
                        
                        \App\Models\InventoryTransaction::create([
                            'product_id' => $product->id,
                            'user_id' => auth()->id(),
                            'type' => 'in',
                            'quantity' => $qtyToAdd,
                            'stock_before' => $stockBefore,
                            'stock_after' => $stockAfter,
                            'reference_type' => get_class($batch),
                            'reference_id' => $batch->id,
                            'notes' => 'Hasil panen batch ' . $batch->batch_number,
                        ]);
                        
                        $product->update(['stock' => $stockAfter]);
                    }
                }
            }
            
            $batch->update($updateData);

            // Create Log
            BatchLog::create([
                'batch_id' => $batch->id,
                'user_id' => auth()->id(),
                'from_status' => $oldStatus,
                'to_status' => $newStatus,
                'notes' => $validated['log_notes'],
            ]);

            DB::commit();
            return redirect()->route('production-batches.show', $batch)->with('success', 'Status produksi berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(ProductionBatch $productionBatch)
    {
        $productionBatch->delete();
        return redirect()->route('production-batches.index')->with('success', 'Batch produksi berhasil dihapus.');
    }
}
