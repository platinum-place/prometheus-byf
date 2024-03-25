<?php

namespace App\Filament\Columns;

use Filament\Tables;
use Filament\Actions\Imports\ImportColumn;

class ImportContactColumns
{
    public static function getColumns($array = [])
    {
        return array_merge($array, [
            ImportColumn::make('name')
                ->label(__('app.name'))
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('phone')
                ->label(__('app.phone'))
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ]);
    }
}
