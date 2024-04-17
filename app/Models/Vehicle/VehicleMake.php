<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleMake extends Model
{
    use HasFactory, SoftDeletes;

    public function models(): HasMany
    {
        return $this->hasMany(VehicleModel::class);
    }
}
