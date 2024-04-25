<?php

namespace App\Enums;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasLabel;

enum PermissionEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case viewAny = 1;

    case view = 2;

    case create = 3;

    case update = 4;

    case delete = 5;

    case restore = 6;

    case forceDelete = 7;
}
