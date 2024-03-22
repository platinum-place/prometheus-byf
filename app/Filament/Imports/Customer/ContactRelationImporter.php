<?php

namespace App\Filament\Imports\Customer;

use App\Enums\Status;
use App\Models\Customer\Contact;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;

class ContactRelationImporter extends Importer
{
    protected static ?string $model = Contact::class;

    public static function getColumns(): array
    {
        return [
            // ImportColumn::make('customer')
            // ->label(__('app.customer'))
            // ->requiredMapping()
            // ->relationship(),
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

    public static function getOptionsFormComponents(): array
    {
        return [
            Checkbox::make('update_existing')
                ->label(__('app.update_existing')),
        ];
    }

    public function resolveRecord(): ?Contact
    {
        $contact = match ($this->options['update_existing']) {
            true => Contact::firstOrNew([
                'name' => $this->data['name'],
            ]),
            default => new Contact(),
        };

        $contact->customer_id = $this->options['customer_id'];
        $contact->status = Status::active;

        return $contact;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = [
            'imported' => number_format($import->successful_rows),
            'failed' => 0,
        ];

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body['failed'] = number_format($failedRowsCount);
        }

        return __('app.import_records_alert', $body);
    }
}
