<?php

namespace App\Filament\Resources\Customer\ContactResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Imports\Customer\ContactImporter;
use App\Filament\Resources\Customer\ContactResource;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->label(__('app.import_model', ['model' => Str::lower(__('app.contact'))]))
                ->importer(ContactImporter::class),
        ];
    }
}
