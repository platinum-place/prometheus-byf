<?php

namespace App\Filament\Resources\Vehicle\VehicleMakeResource\Pages;

use App\Filament\Resources\Vehicle\VehicleMakeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicleMake extends ViewRecord
{
    protected static string $resource = VehicleMakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
