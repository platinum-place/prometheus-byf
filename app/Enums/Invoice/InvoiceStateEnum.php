<?php

namespace App\Enums\Invoice;

use App\Enums\shared\EnumsTrait;
use App\Enums\shared\FilamentEnumsTrait;
use Filament\Support\Contracts\HasLabel;

enum InvoiceStateEnum: int implements HasLabel
{
    use EnumsTrait, FilamentEnumsTrait;

    case draft = 1;

    case issued = 2;

    case partialPaid = 3;

    case paid = 4;
}
