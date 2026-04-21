<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WastePurchaseItem extends Model
{
    protected $fillable = ['waste_purchase_id', 'waste_category_id', 'weight_kg', 'price_per_kg', 'subtotal'];

    protected $casts = [
        'weight_kg' => 'float',
        'price_per_kg' => 'float',
        'subtotal' => 'float',
    ];

    public function wastePurchase()
    {
        return $this->belongsTo(WastePurchase::class);
    }

    public function wasteCategory()
    {
        return $this->belongsTo(WasteCategory::class);
    }
}
