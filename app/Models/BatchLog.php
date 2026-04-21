<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchLog extends Model
{
    protected $fillable = ['batch_id', 'user_id', 'from_status', 'to_status', 'notes'];

    public function batch()
    {
        return $this->belongsTo(ProductionBatch::class, 'batch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
