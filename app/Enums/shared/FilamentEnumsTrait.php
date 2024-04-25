<?php

namespace App\Enums\shared;

trait FilamentEnumsTrait
{
    public function getLabel(): ?string
    {
        return $this->label(); /* Any string works so...*/
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
