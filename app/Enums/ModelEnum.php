<?php

namespace App\Enums;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasLabel;

enum ModelEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case user = 1;

    case vehicle = 2;

    case vehicleMake = 3;

    case vehicleModel = 4;

    case agent = 5;

    case product = 6;

    case supplier = 7;

    case invoice = 8;

    case sale = 9;

    case customer = 10;

    case contact = 11;
}
