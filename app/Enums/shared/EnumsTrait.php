<?php

namespace App\Enums\shared;

use Illuminate\Support\Arr;

trait EnumsTrait
{
    /**
     * Returns all the values of an enum.
     */
    public static function values()
    {
        return Arr::pluck(static::cases(), 'value');
    }

    /**
     * Returns all the names of an enum.
     */
    public static function names(): array
    {
        return Arr::pluck(static::cases(), 'name');
    }

    public function langValue(): string
    {
        return __("app." . $this->value);
    }

    public function getLabel(): ?string
    {
        return $this->langValue();
    }
}
