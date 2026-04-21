<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\WastePurchase;
use App\Models\ProductionBatch;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Today's stats
        $salesToday = Sale::whereDate('sold_at', today())->sum('total_amount');
        $salesThisMonth = Sale::whereMonth('sold_at', now()->month)->whereYear('sold_at', now()->year)->sum('total_amount');
        
        // Counts
        $totalSuppliers = Supplier::count();
        $totalCustomers = Customer::count();
        $totalProducts = Product::where('is_active', true)->count();
        
        // Production
        $activeBatches = ProductionBatch::whereIn('status', ['persiapan', 'fermentasi'])->count();
        $harvestedThisMonth = ProductionBatch::where('status', 'panen')
            ->whereMonth('actual_harvest', now()->month)
            ->whereYear('actual_harvest', now()->year)
            ->sum('yield_liters');

        // Low stock products
        $lowStockProducts = Product::where('is_active', true)
            ->where('stock', '<=', 10)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Waste collected
        $totalWasteKg = WastePurchase::sum('total_weight');
        $totalWastePurchases = WastePurchase::count();
        
        // Recent transactions
        $recentSales = Sale::with(['customer', 'user'])
            ->latest('sold_at')
            ->take(5)
            ->get();

        $recentPurchases = WastePurchase::with(['supplier', 'user'])
            ->latest()
            ->take(5)
            ->get();

        // Chart Data preparation
        $chartDailyLabels = [];
        $chartDailyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartDailyLabels[] = $date->format('d M');
            $chartDailyData[] = Sale::whereDate('sold_at', $date->toDateString())->sum('total_amount');
        }

        $chartWeeklyLabels = [];
        $chartWeeklyData = [];
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = now()->subWeeks($i)->startOfWeek();
            $endOfWeek = now()->subWeeks($i)->endOfWeek();
            $chartWeeklyLabels[] = $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M');
            $chartWeeklyData[] = Sale::whereBetween('sold_at', [$startOfWeek, $endOfWeek])->sum('total_amount');
        }

        $chartMonthlyLabels = [];
        $chartMonthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $chartMonthlyLabels[] = $date->format('M Y');
            $chartMonthlyData[] = Sale::whereMonth('sold_at', $date->month)
                                        ->whereYear('sold_at', $date->year)
                                        ->sum('total_amount');
        }

        $chartData = [
            'daily' => [
                'labels' => $chartDailyLabels,
                'data' => $chartDailyData,
            ],
            'weekly' => [
                'labels' => $chartWeeklyLabels,
                'data' => $chartWeeklyData,
            ],
            'monthly' => [
                'labels' => $chartMonthlyLabels,
                'data' => $chartMonthlyData,
            ],
        ];

        return view('dashboard', compact(
            'salesToday', 'salesThisMonth',
            'totalSuppliers', 'totalCustomers', 'totalProducts',
            'activeBatches', 'harvestedThisMonth',
            'lowStockProducts', 'recentSales', 'recentPurchases',
            'totalWasteKg', 'totalWastePurchases', 'chartData'
        ));
    }
}
