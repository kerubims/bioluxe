<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'sku', 'volume_ml', 'price', 'stock', 'unit', 'description', 'is_active'];

    protected $casts = [
        'volume_ml' => 'float',
        'price' => 'float',
        'stock' => 'float',
    ];

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}
