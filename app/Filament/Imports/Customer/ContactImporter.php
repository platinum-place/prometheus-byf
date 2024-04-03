<?php

namespace App\Filament\Imports\Customer;

use App\Models\Customer\Contact;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;
use App\Filament\Imports\shared\FilamentImportTrait;

class ContactImporter extends Importer
{
    use FilamentImportTrait;

    protected static ?string $model = Contact::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('customer')
                ->label(__('app.customer'))
                ->relationship(),
            ImportColumn::make('name')
                ->label(__('app.name'))
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('phone')
                ->label(__('app.phone')),
        ];
    }

    public function resolveRecord(): ?Contact
    {
        // return Contact::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Contact();
    }
}
