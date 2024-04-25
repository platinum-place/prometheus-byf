<?php

namespace App\Filament\Forms\Components\Vehicle;

use App\Enums\Vehicle\VehicleTypeEnum;
use App\Filament\Forms\Components\RelationSelects;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;

class VehicleFormComponent
{
    public static function getForm($array = [])
    {
        return array_merge($array, [
            Grid::make()
                ->schema(
                    RelationSelects::getVehicleMakeModelForm([
                        Forms\Components\TextInput::make('chassis')
                            ->label(__('app.chassis'))
                            ->required(),
                        Forms\Components\TextInput::make('color')
                            ->label(__('app.color')),
                        Forms\Components\TextInput::make('identification')
                            ->label(__('app.identification')),
                        Forms\Components\TextInput::make('plate')
                            ->label(__('app.plate')),
                        Forms\Components\TextInput::make('year')
                            ->label(__('app.year'))
                            ->numeric(),
                        Select::make('type')
                            ->label(__('app.type'))
                            ->options(VehicleTypeEnum::class)
                            ->required(),
                    ])
                ),
        ]);
    }

    public static function getCreateForm($array = [])
    {
        return array_merge($array, self::getForm());
    }

    public static function getSubCreateForm($array = [])
    {
        return array_merge($array, self::getForm());
    }
}
