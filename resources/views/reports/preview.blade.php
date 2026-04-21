<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Laporan - Sistem POC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .print-area { box-shadow: none !important; margin: 0 !important; padding: 0 !important; }
            @page { margin: 1.5cm; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">

    <!-- Action Bar -->
    <div class="no-print bg-white border-b border-gray-200 px-6 py-4 sticky top-0 z-50 shadow-sm flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Preview Laporan Keuangan</h2>
            <p class="text-sm text-gray-500">Periode: {{ \Carbon\Carbon::parse($startDate)->locale('id')->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->locale('id')->translatedFormat('d F Y') }}</p>
        </div>
        <div class="flex gap-3">
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Cetak / PDF
            </button>
            <a href="{{ route('reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                Download CSV
            </a>
            <button onclick="window.close()" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Tutup
            </button>
        </div>
    </div>

    <!-- Report Content -->
    <div class="max-w-5xl mx-auto my-8 print-area bg-white p-10 shadow-lg rounded-sm border border-gray-200">
        
        <div class="text-center mb-10 border-b-2 border-gray-800 pb-6">
            <h1 class="text-3xl font-bold uppercase tracking-wider text-gray-900">LAPORAN KEUANGAN POC</h1>
            <p class="text-gray-600 mt-2 text-lg">Periode: {{ \Carbon\Carbon::parse($startDate)->locale('id')->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->locale('id')->translatedFormat('d F Y') }}</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-3 gap-6 mb-10">
            <div class="border border-gray-200 p-4 rounded bg-gray-50">
                <p class="text-sm font-bold text-gray-500 uppercase">Total Pendapatan (Penjualan)</p>
                <p class="text-2xl font-bold text-green-600 mt-1">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>
            <div class="border border-gray-200 p-4 rounded bg-gray-50">
                <p class="text-sm font-bold text-gray-500 uppercase">Total Pengeluaran (Sampah)</p>
                <p class="text-2xl font-bold text-red-600 mt-1">Rp {{ number_format($totalPurchases, 0, ',', '.') }}</p>
            </div>
            <div class="border border-gray-200 p-4 rounded bg-gray-50">
                <p class="text-sm font-bold text-gray-500 uppercase">Laba Kotor</p>
                <p class="text-2xl font-bold text-blue-600 mt-1">Rp {{ number_format($grossProfit, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Sales Detail -->
        <div class="mb-10">
            <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">Rincian Penjualan POC</h3>
            <table class="w-full text-left text-sm border border-gray-300">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border-b border-gray-300">Tanggal</th>
                        <th class="px-4 py-2 border-b border-gray-300">No. Invoice</th>
                        <th class="px-4 py-2 border-b border-gray-300">Pelanggan</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($sale->sold_at)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">{{ $sale->invoice_number }}</td>
                            <td class="px-4 py-2">{{ $sale->customer->name ?? 'Umum' }}</td>
                            <td class="px-4 py-2 text-right">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">Tidak ada data penjualan pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Purchases Detail -->
        <div class="mb-10">
            <h3 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">Rincian Pembelian Sampah Organik</h3>
            <table class="w-full text-left text-sm border border-gray-300">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border-b border-gray-300">Tanggal</th>
                        <th class="px-4 py-2 border-b border-gray-300">No. Kwitansi</th>
                        <th class="px-4 py-2 border-b border-gray-300">Supplier</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $purchase)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($purchase->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">{{ $purchase->invoice_number }}</td>
                            <td class="px-4 py-2">{{ $purchase->supplier->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-right">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">Tidak ada data pembelian sampah pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Note -->
        <div class="mt-16 text-sm text-gray-500 flex justify-between">
            <p>Dicetak oleh: {{ auth()->user()->name }}</p>
            <p>Waktu Cetak: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y H:i:s') }}</p>
        </div>

    </div>

</body>
</html>
