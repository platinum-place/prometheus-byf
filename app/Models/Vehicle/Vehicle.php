<?php

namespace App\Models\Vehicle;

use App\Enums\Supplier\VehicleTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => VehicleTypeEnum::class,
        ];
    }

    public function make(): BelongsTo
    {
        return $this->belongsTo(VehicleMake::class);
    }
}
