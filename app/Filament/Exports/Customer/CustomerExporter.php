<?php

namespace App\Filament\Exports\Customer;

use App\Filament\Exports\shared\FilamentExportTrait;
use App\Models\Customer\Customer;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;

class CustomerExporter extends Exporter
{
    use FilamentExportTrait;

    protected static ?string $model = Customer::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('#'),
            ExportColumn::make('created_at')
                ->label(__('app.created_at')),
            ExportColumn::make('updated_at')
                ->label(__('app.updated_at')),
            ExportColumn::make('deleted_at')
                ->label(__('app.deleted_at')),
            ExportColumn::make('name')
                ->label(__('app.name')),
            ExportColumn::make('identification')
                ->label(__('app.identification')),
            ExportColumn::make('phone')
                ->label(__('app.phone')),
        ];
    }
}
