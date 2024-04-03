<?php

namespace App\Filament\Resources\Customer\ContactResource\Pages;

use App\Filament\Resources\Customer\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;
}
