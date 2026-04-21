<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WasteCategoryController;
use App\Http\Controllers\WastePurchaseController;
use App\Http\Controllers\ProductionBatchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Only
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('waste-categories', WasteCategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('settings', SettingController::class)->only(['index', 'store']);
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
        Route::get('reports/preview', [ReportController::class, 'preview'])->name('reports.preview');
        Route::resource('inventory', InventoryTransactionController::class)->only(['index', 'create', 'store']);
    });

    // Staff & Admin
    Route::middleware(['role:admin|staff_produksi'])->group(function () {
        Route::resource('suppliers', SupplierController::class);
        Route::resource('waste-purchases', WastePurchaseController::class);
        Route::get('waste-purchases/{waste_purchase}/print', [WastePurchaseController::class, 'printReceipt'])->name('waste-purchases.print');
        Route::resource('production-batches', ProductionBatchController::class);
        Route::post('production-batches/{batch}/status', [ProductionBatchController::class, 'updateStatus'])->name('production-batches.status');
        
        Route::get('notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    });

    // Cashier & Admin
    Route::middleware(['role:admin|kasir'])->group(function () {
        Route::resource('customers', CustomerController::class);
        Route::resource('sales', SaleController::class);
        Route::get('sales/{sale}/print', [SaleController::class, 'printReceipt'])->name('sales.print');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
