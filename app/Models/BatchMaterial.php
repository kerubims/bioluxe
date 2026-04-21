<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchMaterial extends Model
{
    protected $fillable = ['batch_id', 'material_type', 'quantity', 'unit'];

    protected $casts = [
        'quantity' => 'float',
    ];

    public function batch()
    {
        return $this->belongsTo(ProductionBatch::class, 'batch_id');
    }
}
