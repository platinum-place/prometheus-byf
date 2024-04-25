<?php

namespace App\Filament\Resources\Supplier\AgentResource\Pages;

use App\Filament\Resources\Supplier\AgentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAgent extends ViewRecord
{
    protected static string $resource = AgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
