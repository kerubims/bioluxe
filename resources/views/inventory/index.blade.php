<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Riwayat Stok (Inventory)') }}
            </h2>
            <a href="{{ route('inventory.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Penyesuaian Stok Manual
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
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Produk</th>
                            <th scope="col" class="px-6 py-3">Tipe</th>
                            <th scope="col" class="px-6 py-3">Perubahan</th>
                            <th scope="col" class="px-6 py-3">Stok Akhir</th>
                            <th scope="col" class="px-6 py-3">Referensi</th>
                            <th scope="col" class="px-6 py-3">Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $tx)
                            <tr class="bg-white/60 border-b border-gray-100 dark:bg-gray-800/60 dark:border-gray-700/50 hover:bg-green-50/50 dark:hover:bg-green-900/10 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    {{ $tx->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $tx->product->name ?? 'Produk Terhapus' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($tx->type === 'in')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Masuk</span>
                                    @elseif($tx->type === 'out')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">Keluar</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">Adjustment</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold {{ $tx->type === 'in' ? 'text-green-600' : ($tx->type === 'out' ? 'text-red-600' : 'text-yellow-600') }}">
                                        {{ $tx->type === 'out' ? '-' : '+' }}{{ $tx->quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    {{ $tx->stock_after }}
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    @if($tx->reference_type)
                                        <span class="block text-gray-400 uppercase tracking-wider">{{ class_basename($tx->reference_type) }}</span>
                                        <span class="font-mono text-gray-900 dark:text-white">#{{ $tx->reference_id }}</span>
                                    @else
                                        Manual
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tx->user->name ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    Belum ada riwayat transaksi inventori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
