<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WastePurchase;
use App\Models\WastePurchaseItem;
use App\Models\Supplier;
use App\Models\WasteCategory;
use App\Http\Requests\StoreWastePurchaseRequest;
use App\Http\Requests\UpdateWastePurchaseRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class WastePurchaseController extends Controller
{
    public function index()
    {
        $purchases = WastePurchase::with(['supplier', 'user'])
            ->when(request('search'), function($q) {
                $search = request('search');
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('supplier', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            })
            ->latest()->paginate(10)->withQueryString();
        return view('waste_purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $categories = WasteCategory::where('is_active', true)->get();
        return view('waste_purchases.create', compact('suppliers', 'categories'));
    }

    public function store(StoreWastePurchaseRequest $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();
            
            // Create Invoice Number (e.g., INV-WP-YYYYMMDD-XXXX)
            $date = date('Ymd');
            $lastPurchase = WastePurchase::whereDate('created_at', today())->count() + 1;
            $invoiceNumber = 'INV-WP-' . $date . '-' . str_pad($lastPurchase, 4, '0', STR_PAD_LEFT);

            // Calculate totals (double check from server side to be safe)
            $totalWeight = 0;
            $totalAmount = 0;
            
            foreach ($validated['items'] as $item) {
                $totalWeight += $item['weight_kg'];
                $totalAmount += $item['subtotal'];
            }

            // Create Master Record
            $wastePurchase = WastePurchase::create([
                'invoice_number' => $invoiceNumber,
                'supplier_id' => $validated['supplier_id'],
                'user_id' => auth()->id(),
                'total_weight' => $totalWeight,
                'total_amount' => $totalAmount,
                'amount_paid' => $validated['amount_paid'] ?? 0,
                'payment_status' => $validated['payment_status'],
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create Line Items
            foreach ($validated['items'] as $item) {
                WastePurchaseItem::create([
                    'waste_purchase_id' => $wastePurchase->id,
                    'waste_category_id' => $item['waste_category_id'],
                    'weight_kg' => $item['weight_kg'],
                    'price_per_kg' => $item['price_per_kg'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();
            return redirect()->route('waste-purchases.show', $wastePurchase)->with('success', 'Transaksi pembelian sampah berhasil disimpan.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(WastePurchase $wastePurchase)
    {
        $wastePurchase->load(['supplier', 'user', 'wastePurchaseItems.wasteCategory']);
        return view('waste_purchases.show', ['purchase' => $wastePurchase]);
    }

    public function edit(WastePurchase $wastePurchase)
    {
        return redirect()->route('waste-purchases.show', $wastePurchase)->with('error', 'Fitur edit transaksi belum tersedia.');
    }

    public function update(UpdateWastePurchaseRequest $request, WastePurchase $wastePurchase)
    {
        //
    }

    public function destroy(WastePurchase $wastePurchase)
    {
        $wastePurchase->delete();
        return redirect()->route('waste-purchases.index')->with('success', 'Transaksi pembelian sampah berhasil dihapus.');
    }

    public function printReceipt(WastePurchase $wastePurchase)
    {
        $wastePurchase->load(['supplier', 'user', 'wastePurchaseItems.wasteCategory']);
        $purchase = $wastePurchase;

        // Calculate dynamic height based on number of items
        $baseHeight = 260; // base points for header, title, totals, footer
        $itemHeight = 25;  // points per item
        $totalItems = count($purchase->wastePurchaseItems);
        $paperHeight = $baseHeight + ($totalItems * $itemHeight);

        $pdf = Pdf::loadView('waste_purchases.receipt-pdf', compact('purchase'))
                  ->setPaper(array(0, 0, 164.4, $paperHeight), 'portrait');
        
        $pdfBase64 = base64_encode($pdf->output());
        $filename = 'Kwitansi_' . $purchase->invoice_number . '.pdf';

        return view('waste_purchases.receipt-preview', compact('pdfBase64', 'filename'));
    }
}
