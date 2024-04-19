<?php

namespace App\Enums\shared;

use Illuminate\Support\Arr;

trait EnumsTrait
{
    public static function values()
    {
        return Arr::pluck(static::cases(), 'value');
    }

    public static function names(): array
    {
        return Arr::pluck(static::cases(), 'name');
    }

    /**
     * All translates are in lang/(es,en,etc)/enums.php
     */
    public function langName(): string
    {
        return __('app.'.$this->name);
    }
}
