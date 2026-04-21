<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail & Update Batch: ' . $batch->batch_number) }}
            </h2>
            <a href="{{ route('production-batches.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- Status Tracker Banner -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Status Produksi</h3>
                <div>
                    @if($batch->status === 'persiapan')
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">Persiapan</span>
                    @elseif($batch->status === 'fermentasi')
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">Sedang Fermentasi</span>
                    @elseif($batch->status === 'panen')
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Selesai / Panen</span>
                    @else
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">Gagal</span>
                    @endif
                </div>
            </div>

            <!-- Simple Progress -->
            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2 dark:bg-gray-700">
                <div class="bg-green-600 h-2.5 rounded-full" 
                     style="width: {{ $batch->status === 'persiapan' ? '25%' : ($batch->status === 'fermentasi' ? '60%' : ($batch->status === 'panen' ? '100%' : '100%')) }}; 
                            {{ $batch->status === 'gagal' ? 'background-color: #ef4444;' : '' }}"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-500">
                <span>Persiapan</span>
                <span>Fermentasi (Masa Tunggu 14 Hari)</span>
                <span>Panen</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informasi Komposisi -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b pb-2 dark:border-gray-700">Komposisi Bahan Baku</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex justify-between">
                        <span class="text-gray-500">Total Sampah Organik:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $batch->total_waste_kg }} Kg</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Air:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $batch->water_liters }} Liter</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Starter EM4:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $batch->em4_liters }} Liter</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Molase / Gula:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $batch->molasses_kg }} Kg</span>
                    </li>
                    <li class="flex justify-between border-t pt-2 mt-2">
                        <span class="text-gray-500">Tanggal Mulai:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($batch->started_at)->format('d F Y') }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Estimasi Panen:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($batch->estimated_harvest)->format('d F Y') }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">PIC/Petugas:</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $batch->user->name }}</span>
                    </li>
                </ul>
            </div>

            <!-- Action / Update Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b pb-2 dark:border-gray-700">Update Status</h3>
                
                @if($batch->status === 'panen' || $batch->status === 'gagal')
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <p class="text-gray-500 dark:text-gray-400">Batch ini sudah selesai dan tidak dapat diubah lagi.</p>
                    </div>

                    @if($batch->status === 'panen')
                        <div class="mt-4 bg-green-50 dark:bg-green-900/30 p-4 rounded-lg">
                            <h4 class="font-bold text-green-800 dark:text-green-400 mb-2">Hasil Panen</h4>
                            <ul class="text-sm space-y-2">
                                <li class="flex justify-between">
                                    <span class="text-green-700 dark:text-green-500">Volume POC Didapat:</span>
                                    <span class="font-bold text-green-900 dark:text-green-300">{{ $batch->yield_liters }} Liter</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-green-700 dark:text-green-500">Sisa Ampas Padat:</span>
                                    <span class="font-bold text-green-900 dark:text-green-300">{{ $batch->solid_waste_kg }} Kg</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-green-700 dark:text-green-500">Tanggal Panen Aktual:</span>
                                    <span class="font-bold text-green-900 dark:text-green-300">{{ \Carbon\Carbon::parse($batch->actual_harvest)->format('d F Y') }}</span>
                                </li>
                            </ul>
                        </div>
                    @endif

                @else
                    <form method="POST" action="{{ route('production-batches.status', $batch) }}" class="space-y-4">
                        @csrf
                        
                        <div>
                            <x-input-label for="status" :value="__('Ubah Status Menjadi')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" required onchange="toggleHarvestFields(this.value)">
                                <option value="" disabled selected>-- Pilih Status --</option>
                                @if($batch->status === 'persiapan')
                                    <option value="fermentasi">Fermentasi (Mulai)</option>
                                @endif
                                <option value="panen">Panen (Selesai)</option>
                                <option value="gagal">Gagal / Buang</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <!-- Fields for Harvest (Panen) -->
                        <div id="harvest_fields" class="hidden space-y-4 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg border border-gray-200 dark:border-gray-600 mt-4">
                            <h4 class="font-semibold text-sm text-gray-700 dark:text-gray-300">Input Hasil Panen</h4>
                            
                            <div>
                                <x-input-label for="actual_harvest" :value="__('Tanggal Panen Aktual')" />
                                <x-text-input id="actual_harvest" name="actual_harvest" type="date" class="mt-1 block w-full" :value="date('Y-m-d')" />
                                <x-input-error class="mt-2" :messages="$errors->get('actual_harvest')" />
                            </div>

                            <div>
                                <x-input-label for="yield_liters" :value="__('Hasil POC (Liter)')" />
                                <x-text-input id="yield_liters" name="yield_liters" type="number" step="0.01" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('yield_liters')" />
                            </div>

                            <div>
                                <x-input-label for="solid_waste_kg" :value="__('Sisa Ampas Padat (Kg)')" />
                                <x-text-input id="solid_waste_kg" name="solid_waste_kg" type="number" step="0.01" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('solid_waste_kg')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="log_notes" :value="__('Catatan Perubahan (Opsional)')" />
                            <textarea id="log_notes" name="log_notes" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" rows="2"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('log_notes')" />
                        </div>

                        <div class="pt-2">
                            <x-primary-button class="w-full justify-center bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900">
                                {{ __('Simpan Perubahan Status') }}
                            </x-primary-button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <!-- Timeline Log -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 border-b pb-2 dark:border-gray-700">Riwayat Status (Log)</h3>
            
            <div class="relative border-l border-gray-200 dark:border-gray-700 ml-3">
                @foreach($batch->batchLogs()->latest()->get() as $log)
                    <div class="mb-6 ml-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-green-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-800 dark:bg-green-900">
                            <svg class="w-3 h-3 text-green-800 dark:text-green-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        </span>
                        <h4 class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">
                            Status diubah ke: <span class="uppercase text-green-600 dark:text-green-400">{{ $log->to_status }}</span>
                        </h4>
                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400 dark:text-gray-500">
                            {{ $log->created_at->format('d M Y, H:i') }} oleh {{ $log->user->name }}
                        </time>
                        @if($log->notes)
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400 italic">"{{ $log->notes }}"</p>
                        @endif
                    </div>
                @endforeach
                
                <!-- Initial Creation Log (Simulated) -->
                <div class="ml-6">
                    <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-800 dark:bg-gray-700">
                        <svg class="w-3 h-3 text-gray-800 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    </span>
                    <h4 class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">Batch Dibuat (PERSIAPAN)</h4>
                    <time class="block mb-2 text-xs font-normal leading-none text-gray-400 dark:text-gray-500">
                        {{ $batch->created_at->format('d M Y, H:i') }} oleh {{ $batch->user->name }}
                    </time>
                </div>
            </div>
        </div>

    </div>

    <script>
        function toggleHarvestFields(status) {
            const fields = document.getElementById('harvest_fields');
            const inputs = fields.querySelectorAll('input');
            
            if (status === 'panen') {
                fields.classList.remove('hidden');
                inputs.forEach(input => input.setAttribute('required', 'required'));
            } else {
                fields.classList.add('hidden');
                inputs.forEach(input => input.removeAttribute('required'));
            }
        }
    </script>
</x-app-layout>
