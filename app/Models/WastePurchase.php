<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class WastePurchase extends Model
{
    use SoftDeletes;

    protected $fillable = ['invoice_number', 'supplier_id', 'user_id', 'total_weight', 'total_amount', 'amount_paid', 'payment_status', 'notes', 'purchased_at'];

    protected $casts = [
        'purchased_at' => 'datetime',
        'total_weight' => 'float',
        'total_amount' => 'float',
        'amount_paid' => 'float',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(WastePurchaseItem::class);
    }

    public function wastePurchaseItems()
    {
        return $this->hasMany(WastePurchaseItem::class);
    }
}
