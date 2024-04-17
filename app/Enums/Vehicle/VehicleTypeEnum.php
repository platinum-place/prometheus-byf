<?php

namespace App\Enums\Vehicle;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasLabel;

enum VehicleTypeEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case lightVehicle = 1;

    case heavyVehicle = 2;
}
