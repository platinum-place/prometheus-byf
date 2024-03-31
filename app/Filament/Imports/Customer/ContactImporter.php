<?php

namespace App\Filament\Imports\Customer;

use App\Enums\Status;
use App\Models\Customer\Contact;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;
use App\Filament\Imports\shared\ImportTrait;

class ContactImporter extends Importer
{
    use ImportTrait;

    protected static ?string $model = Contact::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label(__('app.name'))
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('phone')
                ->label(__('app.phone'))
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Contact
    {
        $contact = match (!empty($this->options['update_existing'])) {
            true => Contact::firstOrNew([
                'name' => $this->data['name'],
            ]),
            default => new Contact(),
        };

        $contact->status = Status::active;

        return $contact;
    }
}
