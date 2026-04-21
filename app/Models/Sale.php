<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = ['invoice_number', 'customer_id', 'user_id', 'total_amount', 'amount_paid', 'change_amount', 'payment_status', 'payment_method', 'notes', 'sold_at'];

    protected $casts = [
        'sold_at' => 'datetime',
        'total_amount' => 'float',
        'amount_paid' => 'float',
        'change_amount' => 'float',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
