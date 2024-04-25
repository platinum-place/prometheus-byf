<?php

namespace App\Enums\Invoice;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasLabel;

enum SaleTypeEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case vehicle = 1;
}
