<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Penyesuaian Stok Manual (Adjustment)') }}
            </h2>
            <a href="{{ route('inventory.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                
                <div class="mb-6 bg-blue-50 dark:bg-blue-900/30 p-4 rounded-lg border border-blue-100 dark:border-blue-800 text-sm text-blue-800 dark:text-blue-300">
                    <p class="font-semibold mb-1">Informasi:</p>
                    <p>Gunakan form ini hanya jika ada selisih stok (barang hilang, rusak, atau tambahan stok di luar panen). Stok dari hasil panen atau penjualan akan dihitung secara otomatis oleh sistem.</p>
                </div>

                <form method="POST" action="{{ route('inventory.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="product_id" :value="__('Pilih Produk')" />
                        <select id="product_id" name="product_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" required>
                            <option value="" disabled selected>-- Pilih Produk POC --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (Stok saat ini: {{ $product->stock }})</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('product_id')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="type" :value="__('Jenis Penyesuaian')" />
                            <select id="type" name="type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" required>
                                <option value="in">Stok Masuk (+)</option>
                                <option value="out">Stok Keluar (-)</option>
                                <option value="adjustment">Penyesuaian (Ganti Total Stok)</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>

                        <div>
                            <x-input-label for="quantity" :value="__('Jumlah (Qty)')" />
                            <x-text-input id="quantity" name="quantity" type="number" min="0" class="mt-1 block w-full" :value="old('quantity')" required />
                            <p class="text-xs text-gray-500 mt-1">Jika tipe penyesuaian dipilih, ini akan menjadi stok akhir.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="notes" :value="__('Alasan / Catatan')" />
                        <textarea id="notes" name="notes" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" rows="3" required>{{ old('notes') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <x-primary-button class="bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900">
                            {{ __('Simpan Penyesuaian') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
