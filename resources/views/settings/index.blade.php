<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengaturan Sistem') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('settings.store') }}" class="space-y-6">
                    @csrf

                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informasi Perusahaan</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="company_name" :value="__('Nama Perusahaan / Usaha')" />
                                <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="$settings['company_name'] ?? 'Sistem POC'" required />
                                <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                            </div>

                            <div>
                                <x-input-label for="company_address" :value="__('Alamat')" />
                                <textarea id="company_address" name="company_address" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" rows="2">{{ $settings['company_address'] ?? '' }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('company_address')" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="company_phone" :value="__('No. Telepon')" />
                                    <x-text-input id="company_phone" name="company_phone" type="text" class="mt-1 block w-full" :value="$settings['company_phone'] ?? ''" />
                                    <x-input-error class="mt-2" :messages="$errors->get('company_phone')" />
                                </div>
                                <div>
                                    <x-input-label for="company_email" :value="__('Email')" />
                                    <x-text-input id="company_email" name="company_email" type="email" class="mt-1 block w-full" :value="$settings['company_email'] ?? ''" />
                                    <x-input-error class="mt-2" :messages="$errors->get('company_email')" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Pengaturan Struk</h3>
                        <div>
                            <x-input-label for="receipt_footer" :value="__('Pesan di Bawah Struk')" />
                            <textarea id="receipt_footer" name="receipt_footer" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm" rows="2">{{ $settings['receipt_footer'] ?? 'Terima kasih atas kunjungan Anda!' }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('receipt_footer')" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <x-primary-button class="bg-green-600 hover:bg-green-700 focus:bg-green-700 active:bg-green-900">
                            {{ __('Simpan Pengaturan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
