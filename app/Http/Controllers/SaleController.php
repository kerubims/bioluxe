<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'user'])
            ->when(request('search'), function($q) {
                $search = request('search');
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            })
            ->latest('sold_at')->paginate(10)->withQueryString();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->where('stock', '>', 0)->get();
        $customers = Customer::all();
        return view('sales.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'payment_method' => 'required|in:cash,transfer',
            'amount_paid' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:1',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.subtotal' => 'required|numeric|min:0',
        ]);

        // Server-side recalculate total
        $totalAmount = 0;
        foreach ($validated['items'] as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $amountPaid = $validated['amount_paid'];
        if ($amountPaid < $totalAmount) {
            return back()->withInput()->with('error', 'Uang yang diterima kurang dari total tagihan.');
        }

        $changeAmount = $amountPaid - $totalAmount;

        try {
            DB::beginTransaction();

            // Generate Invoice Number
            $date = date('Ymd');
            $lastSale = Sale::whereDate('created_at', today())->count() + 1;
            $invoiceNumber = 'INV-POS-' . $date . '-' . str_pad($lastSale, 4, '0', STR_PAD_LEFT);

            $sale = Sale::create([
                'invoice_number' => $invoiceNumber,
                'customer_id' => $validated['customer_id'] ?: null,
                'user_id' => auth()->id(),
                'total_amount' => $totalAmount,
                'amount_paid' => $amountPaid,
                'change_amount' => $changeAmount,
                'payment_status' => 'paid',
                'payment_method' => $validated['payment_method'],
                'notes' => $validated['notes'] ?? null,
                'sold_at' => now(),
            ]);

            // Create Line Items and deduct stock
            foreach ($validated['items'] as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                // Deduct stock
                $product = Product::findOrFail($item['product_id']);
                $stockBefore = $product->stock;
                $stockAfter = $stockBefore - $item['quantity'];

                if ($stockAfter < 0) {
                    throw new \Exception("Stok produk '{$product->name}' tidak mencukupi. Tersedia: {$stockBefore}, diminta: {$item['quantity']}");
                }

                $product->update(['stock' => $stockAfter]);

                // Record inventory transaction
                InventoryTransaction::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->id(),
                    'type' => 'out',
                    'quantity' => $item['quantity'],
                    'stock_before' => $stockBefore,
                    'stock_after' => $stockAfter,
                    'reference_type' => Sale::class,
                    'reference_id' => $sale->id,
                    'notes' => 'Penjualan ' . $invoiceNumber,
                ]);
            }

            DB::commit();
            return redirect()->route('sales.show', $sale)->with('success', 'Transaksi penjualan berhasil! Kembalian: Rp ' . number_format($changeAmount, 0, ',', '.'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function show(Sale $sale)
    {
        $sale->load(['customer', 'user', 'saleItems.product']);
        return view('sales.show', compact('sale'));
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Transaksi penjualan berhasil dihapus.');
    }

    public function printReceipt(Sale $sale)
    {
        $sale->load(['customer', 'user', 'saleItems.product']);

        // Calculate dynamic height based on number of items
        $baseHeight = 230; // base points for header, totals, footer
        $itemHeight = 25; // points per item
        $totalItems = count($sale->saleItems);
        $paperHeight = $baseHeight + ($totalItems * $itemHeight);

        $pdf = Pdf::loadView('sales.receipt-pdf', compact('sale'))
                  ->setPaper(array(0, 0, 164.4, $paperHeight), 'portrait'); // 164.4 pt = 58mm width
        
        $pdfBase64 = base64_encode($pdf->output());
        $filename = 'Nota_' . $sale->invoice_number . '.pdf';

        return view('sales.receipt-preview', compact('pdfBase64', 'filename'));
    }
}
