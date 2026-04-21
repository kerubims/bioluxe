<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kwitansi {{ $purchase->invoice_number }}</title>
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

    <div class="text-center font-bold" style="margin-bottom: 6px; font-size: 10px; border-bottom: 1px dashed #000; padding-bottom: 4px;">
        KWITANSI PEMBELIAN SAMPAH
    </div>

    <table class="info-table">
        <tr>
            <td width="35%">No. Kwitansi</td>
            <td width="5%">:</td>
            <td>{{ $purchase->invoice_number }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($purchase->created_at)->locale('id')->translatedFormat('d F Y H:i') }}</td>
        </tr>
        <tr>
            <td>Petugas</td>
            <td>:</td>
            <td>{{ $purchase->user->name }}</td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td>:</td>
            <td>{{ $purchase->supplier->name ?? '-' }}</td>
        </tr>
        <tr>
            <td>Status Bayar</td>
            <td>:</td>
            <td>{{ $purchase->payment_status === 'paid' ? 'LUNAS' : ($purchase->payment_status === 'partial' ? 'SEBAGIAN' : 'BELUM BAYAR') }}</td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>Jenis Sampah</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchase->wastePurchaseItems as $item)
            <tr>
                <td>
                    <span class="item-name">{{ $item->wasteCategory->name ?? 'Kategori Terhapus' }}</span>
                    {{ $item->weight_kg }} Kg x Rp {{ number_format($item->price_per_kg, 0, ',', '.') }}
                </td>
                <td class="text-right"><br>{{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals-table">
        <tr>
            <td width="55%" class="text-right">Total Berat :</td>
            <td class="text-right">{{ $purchase->total_weight }} Kg</td>
        </tr>
        <tr class="grand-total">
            <td class="text-right">TOTAL BAYAR :</td>
            <td class="text-right">Rp {{ number_format($purchase->total_amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-right">Dibayar :</td>
            <td class="text-right">Rp {{ number_format($purchase->amount_paid, 0, ',', '.') }}</td>
        </tr>
        @if($purchase->total_amount - $purchase->amount_paid > 0)
        <tr>
            <td class="text-right">Sisa :</td>
            <td class="text-right">Rp {{ number_format($purchase->total_amount - $purchase->amount_paid, 0, ',', '.') }}</td>
        </tr>
        @endif
    </table>

    <div class="footer">
        <p>Bukti pembayaran yang sah.</p>
        <p>Terima kasih atas kontribusi Anda!</p>
    </div>
</body>
</html>
