<?php

namespace App\Filament\Resources\Vehicle\VehicleModelResource\Pages;

use App\Filament\Resources\Vehicle\VehicleModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleModels extends ListRecords
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
