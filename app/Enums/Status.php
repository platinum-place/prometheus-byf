<?php

namespace App\Enums;

use App\Enums\shared\EnumInterface;
use App\Enums\shared\EnumsTrait;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum Status: int implements HasLabel, HasColor
{
    use EnumsTrait;

    case active = 1;

    case inactive = 2;

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::active => 'success',
            self::inactive => 'danger',
        };
    }
}
