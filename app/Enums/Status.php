<?php

namespace App\Enums;

use App\Enums\shared\EnumInterface;
use App\Enums\shared\EnumsTrait;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum Status: string implements HasLabel, HasColor
{
    use EnumsTrait;

    case active = 'active';

    case inactive = 'inactive';

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::active => 'success',
            self::inactive => 'danger',
        };
    }
}
