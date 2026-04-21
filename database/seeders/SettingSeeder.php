<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'default_fermentation_days', 'value' => '14', 'group' => 'production', 'description' => 'Default masa fermentasi dalam hari'],
            ['key' => 'em4_price_per_liter', 'value' => '25000', 'group' => 'production', 'description' => 'Harga EM4 per liter'],
            ['key' => 'molasses_price_per_kg', 'value' => '15000', 'group' => 'production', 'description' => 'Harga Molase per kg'],
            ['key' => 'company_name', 'value' => 'Sistem POC', 'group' => 'general', 'description' => 'Nama Usaha'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
