<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Supplier') }}
            </h2>
            <a href="{{ route('suppliers.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form method="POST" action="{{ route('suppliers.update', $supplier) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Nama Supplier')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $supplier->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Nomor HP')" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $supplier->phone)" autocomplete="tel" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Alamat')" />
                        <textarea id="address" name="address" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm" rows="3">{{ old('address', $supplier->address) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div>
                        <x-input-label for="notes" :value="__('Catatan Tambahan (Opsional)')" />
                        <textarea id="notes" name="notes" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm" rows="2">{{ old('notes', $supplier->notes) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <x-primary-button class="bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900">
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
