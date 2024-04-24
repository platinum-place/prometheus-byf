<?php

namespace App\Enums;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasLabel;

enum RoleEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case admin = 1;
}
