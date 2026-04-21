<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota {{ $sale->invoice_number }}</title>
    <style>
        @page { margin: 20px 10px 10px 10px; }
        body { 
            font-family: 'Courier New', Courier, monospace; 
            font-size: 10px; 
            color: #000; 
            margin: 0;
            padding: 0;
            line-height: 1.2;
            background: #fff;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
        
        .header { margin-bottom: 8px; border-bottom: 1px dashed #000; padding-bottom: 6px; }
        .logo { max-width: 90px; margin-bottom: 4px; filter: grayscale(100%); }
        .shop-name { font-size: 12px; font-weight: bold; margin: 2px 0; }
        .shop-desc { font-size: 9px; margin: 0; }
        
        .info-table { width: 100%; margin-bottom: 8px; font-size: 9px; }
        .info-table td { vertical-align: top; padding: 1px 0; }
        
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 6px; font-size: 9px; }
        .items-table th { border-bottom: 1px dashed #000; border-top: 1px dashed #000; padding: 3px 0; text-align: left; }
        .items-table td { padding: 4px 0; vertical-align: top; }
        .items-table .item-name { display: block; margin-bottom: 2px; }
        
        .totals-table { width: 100%; font-size: 9px; margin-top: 4px; }
        .totals-table td { padding: 2px 0; }
        .grand-total { font-weight: bold; font-size: 10px; border-top: 1px dashed #000; }
        
        .footer { text-align: center; margin-top: 10px; font-size: 8px; border-top: 1px dashed #000; padding-top: 6px; }
    </style>
</head>
<body>
    <div class="header text-center">
        @if(file_exists(public_path('images/logo.png')))
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" class="logo" alt="Logo">
        @else
            <div class="shop-name">SISTEM POC</div>
        @endif        
        <p class="shop-desc">Jl. Pabrik Pupuk Organik No. 123</p>
        <p class="shop-desc">Telp: 0812-3456-7890</p>
    </div>

    <table class="info-table">
        <tr>
            <td width="35%">No. Nota</td>
            <td width="5%">:</td>
            <td>{{ $sale->invoice_number }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($sale->sold_at)->locale('id')->translatedFormat('d F Y H:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>:</td>
            <td>{{ $sale->user->name }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>:</td>
            <td>{{ $sale->customer->name ?? 'UMUM' }}</td>
        </tr>
        <tr>
            <td>Pembayaran</td>
            <td>:</td>
            <td>{{ strtoupper($sale->payment_method) }}</td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleItems as $item)
            <tr>
                <td>
                    <span class="item-name">{{ $item->product->name ?? 'Produk Terhapus' }}</span>
                    {{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}
                </td>
                <td class="text-right"><br>{{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals-table">
        <tr class="grand-total">
            <td width="55%" class="text-right">TOTAL :</td>
            <td class="text-right">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-right">Tunai ({{ $sale->payment_method }}) :</td>
            <td class="text-right">{{ number_format($sale->amount_paid, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-right">Kembali :</td>
            <td class="text-right">{{ number_format($sale->change_amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima kasih atas kunjungan Anda!</p>
        <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</p>
    </div>
</body>
</html>
