<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'POC Super 500ml', 'sku' => 'POC-500ML', 'volume_ml' => 500, 'price' => 15000, 'unit' => 'Botol'],
            ['name' => 'POC Super 1 Liter', 'sku' => 'POC-1L', 'volume_ml' => 1000, 'price' => 25000, 'unit' => 'Botol'],
            ['name' => 'POC Super 5 Liter', 'sku' => 'POC-5L', 'volume_ml' => 5000, 'price' => 100000, 'unit' => 'Jerigen'],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
}
