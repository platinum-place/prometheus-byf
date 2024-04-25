<?php

namespace App\Filament\Resources\Vehicle\VehicleModelResource\Pages;

use App\Filament\Resources\Vehicle\VehicleModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleModel extends ViewRecord
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
