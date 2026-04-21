<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mulai Batch Produksi Baru') }}
            </h2>
            <a href="{{ route('production-batches.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
            <form method="POST" action="{{ route('production-batches.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-200 dark:border-gray-700 pb-6">
                    <div>
                        <x-input-label for="started_at" :value="__('Tanggal Mulai')" />
                        <x-text-input id="started_at" name="started_at" type="date" class="mt-1 block w-full" :value="old('started_at', date('Y-m-d'))" required />
                        <x-input-error class="mt-2" :messages="$errors->get('started_at')" />
                    </div>

                    <div>
                        <x-input-label for="estimated_harvest" :value="__('Estimasi Panen (Otomatis: +14 Hari)')" />
                        <x-text-input id="estimated_harvest" name="estimated_harvest" type="date" class="mt-1 block w-full bg-gray-50" :value="old('estimated_harvest', date('Y-m-d', strtotime('+14 days')))" required />
                        <x-input-error class="mt-2" :messages="$errors->get('estimated_harvest')" />
                    </div>
                </div>

                <div class="py-2">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Komposisi Bahan Baku</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="total_waste_kg" :value="__('Total Sampah Organik (Kg)')" />
                            <x-text-input id="total_waste_kg" name="total_waste_kg" type="number" step="0.01" class="mt-1 block w-full border-green-300 focus:border-green-500 focus:ring-green-500" :value="old('total_waste_kg')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('total_waste_kg')" />
                        </div>

                        <div>
                            <x-input-label for="water_liters" :value="__('Total Air (Liter)')" />
                            <x-text-input id="water_liters" name="water_liters" type="number" step="0.01" class="mt-1 block w-full border-blue-300 focus:border-blue-500 focus:ring-blue-500" :value="old('water_liters')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('water_liters')" />
                        </div>

                        <div>
                            <x-input-label for="em4_liters" :value="__('Starter EM4 (Liter)')" />
                            <x-text-input id="em4_liters" name="em4_liters" type="number" step="0.01" class="mt-1 block w-full border-yellow-300 focus:border-yellow-500 focus:ring-yellow-500" :value="old('em4_liters')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('em4_liters')" />
                        </div>

                        <div>
                            <x-input-label for="molasses_kg" :value="__('Molase / Gula Merah (Kg)')" />
                            <x-text-input id="molasses_kg" name="molasses_kg" type="number" step="0.01" class="mt-1 block w-full border-orange-300 focus:border-orange-500 focus:ring-orange-500" :value="old('molasses_kg')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('molasses_kg')" />
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                    <x-input-label for="notes" :value="__('Catatan Persiapan (Opsional)')" />
                    <textarea id="notes" name="notes" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" rows="3">{{ old('notes') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('notes')" />
                </div>

                <div class="flex items-center justify-end pt-4">
                    <x-primary-button class="bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900 py-3 px-6">
                        {{ __('Mulai Fermentasi') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Auto Calculate Script (Just basic logic for Estimated Harvest) -->
    <script>
        document.getElementById('started_at').addEventListener('change', function() {
            var date = new Date(this.value);
            date.setDate(date.getDate() + 14); // Default fermentation 14 days
            
            var day = ("0" + date.getDate()).slice(-2);
            var month = ("0" + (date.getMonth() + 1)).slice(-2);
            var dateString = date.getFullYear() + "-" + (month) + "-" + (day);
            
            document.getElementById('estimated_harvest').value = dateString;
        });
    </script>
</x-app-layout>
