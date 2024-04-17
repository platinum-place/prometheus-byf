<?php

namespace App\Filament\Exports\shared;

use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;
use Filament\Actions\Exports\Models\Export;

trait FilamentExportTrait
{
    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = [
            'exported' => number_format($export->successful_rows),
            'failed' => 0,
        ];

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body['failed'] = number_format($failedRowsCount);
        }

        return __('app.export_records_alert', $body);
    }
}
