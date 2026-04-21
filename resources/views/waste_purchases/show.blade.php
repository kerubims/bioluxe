<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail Pembelian Sampah') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('waste-purchases.print', $purchase) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    Cetak Kwitansi
                </a>
                <a href="{{ route('waste-purchases.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <div class="p-8 text-gray-900 dark:text-gray-100 printable-area">
                
                <!-- Invoice Header -->
                <div class="flex justify-between items-start mb-8 border-b border-gray-200 dark:border-gray-700 pb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-green-600 dark:text-green-500 font-inter">INVOICE PEMBELIAN</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">No. {{ $purchase->invoice_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-800 dark:text-gray-200">Sistem POC App</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tanggal: {{ $purchase->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Petugas: {{ $purchase->user->name }}</p>
                    </div>
                </div>

                <!-- Supplier Info -->
                <div class="mb-8 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                    <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Informasi Supplier</h3>
                    <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $purchase->supplier->name ?? 'Terhapus' }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $purchase->supplier->phone ?? '-' }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $purchase->supplier->address ?? '-' }}</p>
                </div>

                <!-- Items Table -->
                <div class="mb-8">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3 rounded-tl-lg">Kategori Sampah</th>
                                <th class="px-4 py-3 text-right">Harga/Kg</th>
                                <th class="px-4 py-3 text-right">Berat (Kg)</th>
                                <th class="px-4 py-3 text-right rounded-tr-lg">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchase->wastePurchaseItems as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-3 font-medium">{{ $item->wasteCategory->name ?? 'Kategori Terhapus' }}</td>
                                    <td class="px-4 py-3 text-right">Rp {{ number_format($item->price_per_kg, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right">{{ $item->weight_kg }}</td>
                                    <td class="px-4 py-3 text-right font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white font-bold border-t-2 border-gray-200 dark:border-gray-600">
                                <td colspan="2" class="px-4 py-4 text-right">TOTAL KESELURUHAN</td>
                                <td class="px-4 py-4 text-right">{{ $purchase->total_weight }} Kg</td>
                                <td class="px-4 py-4 text-right text-lg text-green-600 dark:text-green-500">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Payment Details -->
                <div class="flex justify-between items-start">
                    <div class="w-1/2 pr-4">
                        <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Catatan Tambahan</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 italic">{{ $purchase->notes ?? 'Tidak ada catatan.' }}</p>
                    </div>
                    <div class="w-1/2 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                        <h3 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Status Pembayaran</h3>
                        
                        <div class="flex justify-between mb-2 text-sm">
                            <span class="text-gray-600 dark:text-gray-300">Status</span>
                            <span class="font-bold">
                                @if($purchase->payment_status === 'paid')
                                    <span class="text-green-600 dark:text-green-400">LUNAS</span>
                                @elseif($purchase->payment_status === 'partial')
                                    <span class="text-yellow-600 dark:text-yellow-400">DIBAYAR SEBAGIAN</span>
                                @else
                                    <span class="text-red-600 dark:text-red-400">BELUM DIBAYAR</span>
                                @endif
                            </span>
                        </div>
                        
                        <div class="flex justify-between mb-2 text-sm">
                            <span class="text-gray-600 dark:text-gray-300">Dibayarkan</span>
                            <span class="font-medium">Rp {{ number_format($purchase->amount_paid, 0, ',', '.') }}</span>
                        </div>
                        
                        @if($purchase->payment_status !== 'paid')
                        <div class="flex justify-between text-sm pt-2 border-t border-gray-200 dark:border-gray-600 mt-2">
                            <span class="text-red-600 dark:text-red-400 font-bold">Sisa Tagihan</span>
                            <span class="font-bold text-red-600 dark:text-red-400">Rp {{ number_format($purchase->total_amount - $purchase->amount_paid, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .printable-area, .printable-area * {
                visibility: visible;
            }
            .printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            nav, header, footer, .min-h-screen {
                background: white !important;
            }
        }
    </style>
</x-app-layout>
