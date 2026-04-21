<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Customer;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Demo Suppliers
        $suppliers = [
            ['name' => 'Bank Sampah Mawar', 'phone' => '081200001111', 'address' => 'Jl. Melati No. 12, Kota Bandung'],
            ['name' => 'Pak Ujang - Pengepul Organik', 'phone' => '081200002222', 'address' => 'Jl. Raya Cimahi No. 45'],
            ['name' => 'Koperasi Hijau Lestari', 'phone' => '081200003333', 'address' => 'Jl. Lingkungan Bersih No. 8, Garut'],
        ];

        foreach ($suppliers as $s) {
            Supplier::firstOrCreate(['name' => $s['name']], $s);
        }

        // Demo Customers
        $customers = [
            ['name' => 'Toko Pertanian Subur Jaya', 'phone' => '089900001111', 'address' => 'Jl. Pasar Tani No. 5, Bandung'],
            ['name' => 'Kelompok Tani Maju', 'phone' => '089900002222', 'address' => 'Jl. Sawah Luas No. 10, Sumedang'],
            ['name' => 'Ibu Siti (Perorangan)', 'phone' => '089900003333', 'address' => 'Perumahan Griya Asri Blok C-12'],
        ];

        foreach ($customers as $c) {
            Customer::firstOrCreate(['name' => $c['name']], $c);
        }
    }
}
