<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan & Analisis') }}
        </h2>
    </x-slot>

    <div class="space-y-6">

        <!-- Date Filter -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
            <form method="GET" action="{{ route('reports.index') }}" class="flex flex-col md:flex-row items-end gap-4">
                <div class="flex-1">
                    <x-input-label for="start_date" :value="__('Dari Tanggal')" />
                    <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="$startDate" />
                </div>
                <div class="flex-1">
                    <x-input-label for="end_date" :value="__('Sampai Tanggal')" />
                    <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="$endDate" />
                </div>
                <div class="flex gap-2">
                    <x-primary-button class="bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        {{ __('Filter') }}
                    </x-primary-button>
                    <a href="{{ route('reports.preview', ['start_date' => $startDate, 'end_date' => $endDate]) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        Preview Laporan
                    </a>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Penjualan -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-100 dark:bg-green-900 rounded-lg">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Pendapatan</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500">{{ $totalSalesCount }} transaksi</p>
                    </div>
                </div>
            </div>

            <!-- Total Pembelian Sampah -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-red-100 dark:bg-red-900 rounded-lg">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Pengeluaran Beli Sampah</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalPurchases, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500">{{ $totalPurchasesCount }} transaksi · {{ number_format($totalWasteKg, 1) }} Kg</p>
                    </div>
                </div>
            </div>

            <!-- Produksi -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Produksi</p>
                        <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $totalBatches }} Batch</p>
                        <p class="text-xs text-gray-500">{{ $harvestedBatches }} selesai · {{ number_format($totalYield, 1) }} L POC</p>
                    </div>
                </div>
            </div>

            <!-- Laba Kotor -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 {{ $grossProfit >= 0 ? 'bg-blue-100 dark:bg-blue-900' : 'bg-red-100 dark:bg-red-900' }} rounded-lg">
                        <svg class="w-6 h-6 {{ $grossProfit >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-red-600 dark:text-red-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold">Laba Kotor</p>
                        <p class="text-xl font-bold {{ $grossProfit >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">Rp {{ number_format($grossProfit, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500">Pendapatan - Biaya Beli</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Sales Table -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Transaksi Penjualan Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b border-gray-200 dark:border-gray-600">
                        <tr>
                            <th class="px-4 py-3">Invoice</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Pelanggan</th>
                            <th class="px-4 py-3 text-right">Total</th>
                            <th class="px-4 py-3">Kasir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentSales as $sale)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-3 font-mono font-medium text-gray-900 dark:text-white">{{ $sale->invoice_number }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($sale->sold_at)->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3">{{ $sale->customer->name ?? 'Umum' }}</td>
                                <td class="px-4 py-3 text-right font-bold text-green-600 dark:text-green-400">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $sale->user->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Belum ada data penjualan pada periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
