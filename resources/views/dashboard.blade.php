<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="space-y-6">

        <!-- Welcome Banner -->
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 shadow-soft-xl sm:rounded-2xl p-6 md:p-8 text-white">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/4"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold">Selamat datang, {{ auth()->user()->name }}! 👋</h2>
                    <p class="text-green-100 mt-2 text-sm md:text-base">Berikut ringkasan operasional hari ini — {{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="hidden md:block">
                    <svg class="w-24 h-24 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                </div>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm overflow-hidden shadow-soft sm:rounded-2xl border border-gray-200/50 dark:border-gray-700/50 p-6 hover:shadow-soft-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl shrink-0 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Batch Aktif</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $activeBatches }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Hasil bulan ini: {{ number_format($harvestedThisMonth, 1) }} L</p>
                    </div>
                </div>
            </div>

            <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm overflow-hidden shadow-soft sm:rounded-2xl border border-gray-200/50 dark:border-gray-700/50 p-6 hover:shadow-soft-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-orange-400 to-red-500 rounded-xl shrink-0 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Sampah Terkumpul</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($totalWasteKg, 0, ',', '.') }} Kg</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $totalWastePurchases }} transaksi pembelian</p>
                    </div>
                </div>
            </div>

            <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm overflow-hidden shadow-soft sm:rounded-2xl border border-gray-200/50 dark:border-gray-700/50 p-6 hover:shadow-soft-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl shrink-0 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Produk Aktif</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalProducts }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $totalSuppliers }} Supplier · {{ $totalCustomers }} Customer</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Low Stock Alert -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm overflow-hidden shadow-soft sm:rounded-2xl border border-gray-200/50 dark:border-gray-700/50 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="p-1.5 bg-gradient-to-br from-red-400 to-rose-500 rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg>
                    </span>
                    Stok Menipis
                </h3>
                @if($lowStockProducts->count() > 0)
                    <ul class="space-y-3">
                        @foreach($lowStockProducts as $product)
                            <li class="flex justify-between items-center p-3 bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/10 rounded-xl border border-red-100/80 dark:border-red-800/40 hover:shadow-sm transition-all duration-200">
                                <div>
                                    <p class="font-semibold text-sm text-gray-900 dark:text-white">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $product->sku }}</p>
                                </div>
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full {{ $product->stock <= 5 ? 'bg-gradient-to-r from-red-500 to-rose-500 text-white shadow-sm' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $product->stock }} unit
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-6 text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-2 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <p class="text-sm">Semua stok aman!</p>
                    </div>
                @endif
            </div>

            <!-- Grafik Penjualan -->
            <div class="lg:col-span-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm overflow-hidden shadow-soft sm:rounded-2xl border border-gray-200/50 dark:border-gray-700/50 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                        <span class="p-1.5 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        </span>
                        Grafik Penjualan
                    </h3>
                    <select id="salesChartFilter" class="text-xs py-1.5 px-3 border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 bg-gray-50" onchange="updateSalesChart(this.value)">
                        <option value="daily">7 Hari Terakhir</option>
                        <option value="weekly">4 Minggu Terakhir</option>
                        <option value="monthly">6 Bulan Terakhir</option>
                    </select>
                </div>
                <div class="relative h-64 w-full">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

        </div>

        <!-- Recent Sales -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm overflow-hidden shadow-soft sm:rounded-2xl border border-gray-200/50 dark:border-gray-700/50 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <span class="p-1.5 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </span>
                    Penjualan Terbaru
                </h3>
                <a href="{{ route('sales.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium hover:underline transition-colors">Lihat Semua →</a>
            </div>
            <div class="overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700/50">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-600 uppercase bg-gradient-to-r from-gray-50 to-gray-100/80 dark:from-gray-700 dark:to-gray-700/80 dark:text-gray-400 border-b border-gray-200/50">
                        <tr>
                            <th class="px-5 py-3">Invoice</th>
                            <th class="px-5 py-3">Pelanggan</th>
                            <th class="px-5 py-3 text-right">Total</th>
                            <th class="px-5 py-3">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentSales as $sale)
                            <tr class="border-b border-gray-100 dark:border-gray-700/50 hover:bg-green-50/50 dark:hover:bg-green-900/10 transition-colors duration-150">
                                <td class="px-5 py-3 font-mono text-xs font-medium text-gray-900 dark:text-white">{{ $sale->invoice_number }}</td>
                                <td class="px-5 py-3">{{ $sale->customer->name ?? 'Umum' }}</td>
                                <td class="px-5 py-3 text-right font-bold text-green-600 dark:text-green-400">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-xs text-gray-400">{{ \Carbon\Carbon::parse($sale->sold_at)->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-5 py-8 text-center text-gray-400">Belum ada penjualan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Purchases -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm overflow-hidden shadow-soft sm:rounded-2xl border border-gray-200/50 dark:border-gray-700/50 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <span class="p-1.5 bg-gradient-to-br from-orange-400 to-amber-500 rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </span>
                    Pembelian Sampah Terbaru
                </h3>
                <a href="{{ route('waste-purchases.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium hover:underline transition-colors">Lihat Semua →</a>
            </div>
            <div class="overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700/50">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-600 uppercase bg-gradient-to-r from-gray-50 to-gray-100/80 dark:from-gray-700 dark:to-gray-700/80 dark:text-gray-400 border-b border-gray-200/50">
                        <tr>
                            <th class="px-5 py-3">Invoice</th>
                            <th class="px-5 py-3">Supplier</th>
                            <th class="px-5 py-3">Berat</th>
                            <th class="px-5 py-3 text-right">Total</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentPurchases as $purchase)
                            <tr class="border-b border-gray-100 dark:border-gray-700/50 hover:bg-orange-50/50 dark:hover:bg-orange-900/10 transition-colors duration-150">
                                <td class="px-5 py-3 font-mono text-xs font-medium text-gray-900 dark:text-white">{{ $purchase->invoice_number }}</td>
                                <td class="px-5 py-3">{{ $purchase->supplier->name ?? 'Terhapus' }}</td>
                                <td class="px-5 py-3">{{ $purchase->total_weight }} Kg</td>
                                <td class="px-5 py-3 text-right font-medium">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                                <td class="px-5 py-3">
                                    @if($purchase->payment_status === 'paid')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 dark:from-green-900/40 dark:to-emerald-900/40 dark:text-green-300">Lunas</span>
                                    @elseif($purchase->payment_status === 'partial')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 dark:from-yellow-900/40 dark:to-amber-900/40 dark:text-yellow-300">Sebagian</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-red-100 to-rose-100 text-red-800 dark:from-red-900/40 dark:to-rose-900/40 dark:text-red-300">Belum</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-xs text-gray-400">{{ $purchase->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-5 py-8 text-center text-gray-400">Belum ada pembelian sampah.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);
        let salesChart;
        
        function initSalesChart() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const defaultData = chartData.daily;
            
            const gradient = ctx.createLinearGradient(0, 0, 0, 250);
            gradient.addColorStop(0, 'rgba(16, 185, 129, 0.25)');
            gradient.addColorStop(1, 'rgba(16, 185, 129, 0.01)');
            
            salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: defaultData.labels,
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: defaultData.data,
                        borderColor: '#10b981',
                        backgroundColor: gradient,
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleFont: { size: 12, weight: '600' },
                            bodyFont: { size: 12 },
                            padding: 12,
                            cornerRadius: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 11 } }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.04)' },
                            ticks: {
                                font: { size: 11 },
                                callback: function(value) {
                                    if (value === 0) return '0';
                                    if (value >= 1000000) return 'Rp ' + (value / 1000000) + ' Jt';
                                    if (value >= 1000) return 'Rp ' + (value / 1000) + ' Rb';
                                    return 'Rp ' + value;
                                }
                            }
                        }
                    }
                }
            });
        }
        
        function updateSalesChart(filter) {
            if (!salesChart) return;
            const newData = chartData[filter];
            salesChart.data.labels = newData.labels;
            salesChart.data.datasets[0].data = newData.data;
            salesChart.update('active');
        }
        
        document.addEventListener('DOMContentLoaded', initSalesChart);
    </script>
</x-app-layout>
