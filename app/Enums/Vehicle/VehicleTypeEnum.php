<?php

namespace App\Enums\Supplier;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum VehicleTypeEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case light = 1;

    case heavy = 1;
}
