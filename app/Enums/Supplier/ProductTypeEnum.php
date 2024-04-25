<?php

namespace App\Enums\Supplier;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasLabel;

enum ProductTypeEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case service = 1;

    case storagable = 2;
}
