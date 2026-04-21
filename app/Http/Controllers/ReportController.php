<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sale;
use App\Models\WastePurchase;
use App\Models\ProductionBatch;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        // Sales Report
        $totalSales = Sale::whereBetween('sold_at', [$startDate, Carbon::parse($endDate)->endOfDay()])->sum('total_amount');
        $totalSalesCount = Sale::whereBetween('sold_at', [$startDate, Carbon::parse($endDate)->endOfDay()])->count();

        // Purchase Report
        $totalPurchases = WastePurchase::whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])->sum('total_amount');
        $totalPurchasesCount = WastePurchase::whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])->count();
        $totalWasteKg = WastePurchase::whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])->sum('total_weight');

        // Production Report
        $totalBatches = ProductionBatch::whereBetween('created_at', [$startDate, Carbon::parse($endDate)->endOfDay()])->count();
        $harvestedBatches = ProductionBatch::where('status', 'panen')
            ->whereBetween('actual_harvest', [$startDate, Carbon::parse($endDate)->endOfDay()])
            ->count();
        $totalYield = ProductionBatch::where('status', 'panen')
            ->whereBetween('actual_harvest', [$startDate, Carbon::parse($endDate)->endOfDay()])
            ->sum('yield_liters');

        // Profit Margin (simplified)
        $grossProfit = $totalSales - $totalPurchases;

        // Recent Sales
        $recentSales = Sale::with(['customer', 'user'])
            ->whereBetween('sold_at', [$startDate, Carbon::parse($endDate)->endOfDay()])
            ->latest('sold_at')
            ->take(10)
            ->get();

        return view('reports.index', compact(
            'startDate', 'endDate',
            'totalSales', 'totalSalesCount',
            'totalPurchases', 'totalPurchasesCount', 'totalWasteKg',
            'totalBatches', 'harvestedBatches', 'totalYield',
            'grossProfit', 'recentSales'
        ));
    }

    public function preview(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Ambil data penjualan
        $sales = Sale::with('customer')
            ->whereBetween('sold_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();
        $totalSales = $sales->sum('total_amount');

        // Ambil data pembelian sampah
        $purchases = WastePurchase::with('supplier')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();
        $totalPurchases = $purchases->sum('total_amount');

        $grossProfit = $totalSales - $totalPurchases;

        return view('reports.preview', compact('startDate', 'endDate', 'sales', 'purchases', 'totalSales', 'totalPurchases', 'grossProfit'));
    }

    public function export(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        $endDateTime = Carbon::parse($endDate)->endOfDay();

        $sales = Sale::with(['customer', 'user'])
            ->whereBetween('sold_at', [$startDate, $endDateTime])
            ->latest('sold_at')
            ->get();

        $purchases = WastePurchase::with(['supplier', 'user'])
            ->whereBetween('created_at', [$startDate, $endDateTime])
            ->latest()
            ->get();

        $totalSales = $sales->sum('total_amount');
        $totalPurchases = $purchases->sum('total_amount');

        $filename = 'Laporan_BioLuxe_' . $startDate . '_sd_' . $endDate . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($sales, $purchases, $totalSales, $totalPurchases, $startDate, $endDate) {
            $file = fopen('php://output', 'w');
            // BOM for Excel UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header
            fputcsv($file, ['LAPORAN KEUANGAN BIOLUXE'], ';');
            fputcsv($file, ['Periode: ' . $startDate . ' s/d ' . $endDate], ';');
            fputcsv($file, [''], ';');

            // Sales section
            fputcsv($file, ['=== PENJUALAN ==='], ';');
            fputcsv($file, ['No', 'Invoice', 'Tanggal', 'Pelanggan', 'Kasir', 'Total (Rp)', 'Metode'], ';');
            foreach ($sales as $i => $sale) {
                fputcsv($file, [
                    $i + 1,
                    $sale->invoice_number,
                    Carbon::parse($sale->sold_at)->format('d/m/Y H:i'),
                    $sale->customer->name ?? 'Umum',
                    $sale->user->name,
                    $sale->total_amount,
                    strtoupper($sale->payment_method),
                ], ';');
            }
            fputcsv($file, ['', '', '', '', 'TOTAL PENJUALAN', $totalSales, ''], ';');
            fputcsv($file, [''], ';');

            // Purchases section
            fputcsv($file, ['=== PEMBELIAN SAMPAH ==='], ';');
            fputcsv($file, ['No', 'Invoice', 'Tanggal', 'Supplier', 'Berat (Kg)', 'Total (Rp)', 'Status'], ';');
            foreach ($purchases as $i => $purchase) {
                fputcsv($file, [
                    $i + 1,
                    $purchase->invoice_number,
                    $purchase->created_at->format('d/m/Y H:i'),
                    $purchase->supplier->name ?? '-',
                    $purchase->total_weight,
                    $purchase->total_amount,
                    $purchase->payment_status === 'paid' ? 'Lunas' : 'Belum',
                ], ';');
            }
            fputcsv($file, ['', '', '', '', 'TOTAL PEMBELIAN', $totalPurchases, ''], ';');
            fputcsv($file, [''], ';');

            // Summary
            fputcsv($file, ['=== RINGKASAN ==='], ';');
            fputcsv($file, ['Total Pendapatan', $totalSales], ';');
            fputcsv($file, ['Total Pengeluaran', $totalPurchases], ';');
            fputcsv($file, ['Laba Kotor', $totalSales - $totalPurchases], ';');

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
