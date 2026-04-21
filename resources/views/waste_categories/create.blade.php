<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Kategori Sampah') }}
            </h2>
            <a href="{{ route('waste-categories.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('waste-categories.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Kategori')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="price_per_kg" :value="__('Harga Beli per Kg (Rp)')" />
                        <x-text-input id="price_per_kg" name="price_per_kg" type="number" step="0.01" class="mt-1 block w-full" :value="old('price_per_kg')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('price_per_kg')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Deskripsi')" />
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm" rows="3">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="block mt-4">
                        <label for="is_active" class="inline-flex items-center">
                            <input id="is_active" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-green-600 shadow-sm focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-gray-800" name="is_active" value="1" checked>
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Aktif') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <x-primary-button class="bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900">
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
