<?php

namespace App\Enums\Supplier;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProductTypeEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case storagable = 1;

    case service = 2;
}
