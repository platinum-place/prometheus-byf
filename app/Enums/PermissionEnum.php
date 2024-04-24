<?php

namespace App\Enums;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasLabel;

enum PermissionEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case create = 1;

    case read = 2;

    case update = 3;

    case delete = 4;
}
