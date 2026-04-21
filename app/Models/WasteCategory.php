<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class WasteCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'price_per_kg', 'description', 'is_active'];

    protected $casts = [
        'price_per_kg' => 'float',
    ];

    public function wastePurchaseItems()
    {
        return $this->hasMany(WastePurchaseItem::class);
    }
}
