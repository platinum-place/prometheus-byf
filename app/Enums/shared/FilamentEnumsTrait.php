<?php

namespace App\Enums\shared;

use Illuminate\Support\Arr;

trait FilamentEnumsTrait
{
    public function getLabel(): ?string
    {
        return $this->langName(); /* Any string works so...*/
    }

    public function getColor(): string|array|null
    {
        return null;
        /*
        return match ($this) {
            self::active => 'success',
            self::inactive => 'danger',
        };
        */
    }
}
