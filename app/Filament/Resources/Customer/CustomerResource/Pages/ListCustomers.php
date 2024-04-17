<?php

namespace App\Filament\Resources\Customer\CustomerResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Exports\Customer\CustomerExporter;
use App\Filament\Imports\Customer\CustomerImporter;
use App\Filament\Resources\Customer\CustomerResource;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // ImportAction::make()
            //     ->label(__('app.import_model', ['model' => __('app.customers')]))
            //     ->importer(CustomerImporter::class),
            // ExportAction::make()
            //     ->label(__('app.export_model', ['model' => __('app.customers')]))
            //     ->exporter(CustomerExporter::class)
        ];
    }
}
