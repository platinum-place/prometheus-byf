<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class);
    }
}
