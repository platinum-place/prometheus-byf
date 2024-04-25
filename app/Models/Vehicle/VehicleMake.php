<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleMake extends Model
{
    use HasFactory, SoftDeletes;

    public function vehicleModels(): HasMany
    {
        return $this->hasMany(VehicleModel::class);
    }
}
