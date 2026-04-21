<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Riwayat Penjualan (POS)') }}
            </h2>
            <a href="{{ route('sales.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Buka Kasir Baru
            </a>
        </div>
    </x-slot>

    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm overflow-hidden shadow-soft sm:rounded-2xl border border-gray-200/50 dark:border-gray-700/50">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            
            @if (session('success'))
                <div class="mb-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30 border border-green-200/60 dark:border-green-800/40 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

                        <!-- Search Bar -->
            <div class="mb-4 flex flex-col sm:flex-row justify-end gap-4">
                <form method="GET" action="{{ url()->current() }}" class="flex gap-2 w-full sm:w-1/2 md:w-1/3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data..." class="w-full border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 text-sm bg-gray-50/50">
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-gray-700 to-gray-800 dark:from-gray-200 dark:to-gray-300 border border-transparent rounded-lg font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:from-gray-800 hover:to-gray-900 dark:hover:from-white dark:hover:to-white transition-all duration-200 shadow-sm">Cari</button>
                    @if(request('search'))
                        <a href="{{ url()->current() }}" class="px-4 py-2 bg-gray-100 dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-lg font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-500 transition-all duration-200 inline-flex items-center">Reset</a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-600 uppercase bg-gradient-to-r from-gray-50 to-gray-100/80 dark:from-gray-700 dark:to-gray-700/80 dark:text-gray-400 border-b border-gray-200/50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No. Invoice</th>
                            <th scope="col" class="px-6 py-3">Waktu</th>
                            <th scope="col" class="px-6 py-3">Pelanggan</th>
                            <th scope="col" class="px-6 py-3">Total Belanja</th>
                            <th scope="col" class="px-6 py-3">Metode Bayar</th>
                            <th scope="col" class="px-6 py-3">Kasir</th>
                            <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $sale)
                            <tr class="bg-white/60 border-b border-gray-100 dark:bg-gray-800/60 dark:border-gray-700/50 hover:bg-green-50/50 dark:hover:bg-green-900/10 transition-colors duration-150">
                                <td class="px-6 py-4 font-mono font-medium text-gray-900 dark:text-white">
                                    {{ $sale->invoice_number }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($sale->sold_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->customer->name ?? 'Pelanggan Umum' }}
                                </td>
                                <td class="px-6 py-4 font-bold text-green-600 dark:text-green-500">
                                    Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="uppercase text-xs tracking-wider {{ $sale->payment_method === 'cash' ? 'text-blue-600' : 'text-purple-600' }} font-semibold">
                                        {{ $sale->payment_method }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $sale->user->name }}
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-2">
                                    <a href="{{ route('sales.show', $sale) }}" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors dark:text-emerald-400 dark:hover:bg-emerald-900/50" title="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    Belum ada transaksi penjualan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $sales->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
