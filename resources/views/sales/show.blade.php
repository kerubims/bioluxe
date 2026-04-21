<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Invoice Penjualan') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('sales.print', $sale) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    Cetak Struk
                </a>
                <a href="{{ route('sales.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 transition ease-in-out duration-150">
                    Kasir Baru
                </a>
                <a href="{{ route('sales.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                    Riwayat
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <div class="p-8 text-gray-900 dark:text-gray-100">
                
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Receipt Header -->
                <div class="text-center mb-6 border-b border-gray-200 dark:border-gray-700 pb-6">
                    <img src="{{ asset('images/logo.png') }}" alt="BioLuxe Logo" class="h-16 mx-auto mb-2 dark:invert">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Jl. Pabrik Pupuk Organik No. 123</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Telp: 0812-3456-7890</p>
                </div>

                <div class="flex justify-between items-start mb-6 text-sm">
                    <div>
                        <p><span class="text-gray-500 dark:text-gray-400">No. Nota:</span> <span class="font-mono font-bold">{{ $sale->invoice_number }}</span></p>
                        <p><span class="text-gray-500 dark:text-gray-400">Tanggal:</span> {{ \Carbon\Carbon::parse($sale->sold_at)->locale('id')->translatedFormat('d F Y H:i') }}</p>
                        <p><span class="text-gray-500 dark:text-gray-400">Kasir:</span> {{ $sale->user->name }}</p>
                    </div>
                    <div class="text-right">
                        <p><span class="text-gray-500 dark:text-gray-400">Pelanggan:</span></p>
                        <p class="font-bold">{{ $sale->customer->name ?? 'UMUM' }}</p>
                        @if($sale->customer)
                            <p class="text-gray-500 dark:text-gray-400">{{ $sale->customer->phone }}</p>
                        @endif
                    </div>
                </div>

                <!-- Items Table -->
                <div class="mb-6 overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase border-b border-gray-200 dark:border-gray-700">
                            <tr>
                                <th class="py-2">Item</th>
                                <th class="py-2 text-center">Qty</th>
                                <th class="py-2 text-right">Harga</th>
                                <th class="py-2 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($sale->saleItems as $item)
                                <tr>
                                    <td class="py-3 font-medium">{{ $item->product->name ?? 'Produk Terhapus' }}</td>
                                    <td class="py-3 text-center">{{ $item->quantity }}</td>
                                    <td class="py-3 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="py-3 text-right font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="border-t-2 border-dashed border-gray-300 dark:border-gray-600 pt-4 mb-8">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600 dark:text-gray-400">Total Belanja:</span>
                        <span class="font-bold text-lg">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600 dark:text-gray-400">Metode Pembayaran:</span>
                        <span class="uppercase font-semibold text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{{ $sale->payment_method }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600 dark:text-gray-400">Tunai / Diterima:</span>
                        <span>Rp {{ number_format($sale->amount_paid, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <span class="font-bold">Kembalian:</span>
                        <span class="font-bold text-xl {{ $sale->change_amount > 0 ? 'text-blue-600 dark:text-blue-400' : '' }}">Rp {{ number_format($sale->change_amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center text-gray-500 dark:text-gray-400 text-sm">
                    <p>Terima kasih atas kunjungan Anda!</p>
                    <p class="mt-1 text-xs">Simpan struk cetak sebagai bukti pembayaran yang sah.</p>
                </div>

            </div>
</x-app-layout>
