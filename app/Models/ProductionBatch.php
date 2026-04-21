<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionBatch extends Model
{
    use SoftDeletes;

    protected $fillable = ['batch_number', 'user_id', 'status', 'total_waste_kg', 'em4_liters', 'molasses_kg', 'water_liters', 'started_at', 'estimated_harvest', 'actual_harvest', 'yield_liters', 'solid_waste_kg', 'notes'];

    protected $casts = [
        'started_at' => 'date',
        'estimated_harvest' => 'date',
        'actual_harvest' => 'date',
        'total_waste_kg' => 'float',
        'em4_liters' => 'float',
        'molasses_kg' => 'float',
        'water_liters' => 'float',
        'yield_liters' => 'float',
        'solid_waste_kg' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materials()
    {
        return $this->hasMany(BatchMaterial::class, 'batch_id');
    }

    public function logs()
    {
        return $this->hasMany(BatchLog::class, 'batch_id');
    }

    public function batchLogs()
    {
        return $this->hasMany(BatchLog::class, 'batch_id');
    }
}
