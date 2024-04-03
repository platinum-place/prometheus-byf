<?php

namespace App\Filament\Imports\shared;

use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;

trait FilamentImportTrait
{
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

    public static function getOptionsFormComponents(): array
    {
        return [
            Checkbox::make('update_existing')
                ->label(__('app.update_existing')),
        ];
    }
}
