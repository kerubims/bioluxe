<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Produk POC') }}
            </h2>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Produk
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
                            <th scope="col" class="px-6 py-3">SKU</th>
                            <th scope="col" class="px-6 py-3">Nama Produk</th>
                            <th scope="col" class="px-6 py-3">Harga</th>
                            <th scope="col" class="px-6 py-3">Stok</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="bg-white/60 border-b border-gray-100 dark:bg-gray-800/60 dark:border-gray-700/50 hover:bg-green-50/50 dark:hover:bg-green-900/10 transition-colors duration-150">
                                <td class="px-6 py-4 font-mono text-sm">
                                    {{ $product->sku }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $product->name }}
                                    <div class="text-xs text-gray-500">{{ $product->volume_ml }} ML | {{ $product->unit }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="{{ $product->stock <= 10 ? 'text-red-600 font-bold' : '' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($product->is_active)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-2">
                                    <a href="{{ route('products.edit', $product) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors dark:text-blue-400 dark:hover:bg-blue-900/50" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors dark:text-red-400 dark:hover:bg-red-900/50" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    Belum ada data produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
