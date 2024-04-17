<?php

namespace App\Filament\Resources\Vehicle;

use App\Enums\Vehicle\VehicleTypeEnum;
use App\Filament\Resources\Vehicle\VehicleResource\Pages;
use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\VehicleModel;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Illuminate\Support\Collection;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('app.vehicle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.vehicles');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('app.vehicles');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vehicle_make_id')
                    ->label(__('app.make'))
                    ->relationship('vehicleMake', 'name')
                    ->searchable()
                    ->preload()
                    ->live(),
                Forms\Components\Select::make('vehicle_model_id')
                    ->label(__('app.model'))
                    ->relationship(
                        'vehicleModel',
                        'name',
                        fn (Builder $query, Get $get) => $query->where('vehicle_make_id', $get('vehicle_make_id'))
                    )
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                Forms\Components\TextInput::make('chassis')
                    ->label(__('app.chassis')),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                \App\Filament\Tables\Components\TableColumns::getDateColumns([
                    Tables\Columns\TextColumn::make('vehicleMake.name')
                        ->label(__('app.make')),
                    Tables\Columns\TextColumn::make('vehicleModel.name')
                        ->label(__('app.model')),
                    Tables\Columns\TextColumn::make('chassis')
                        ->label(__('app.chassis'))
                        ->searchable(),
                    Tables\Columns\TextColumn::make('identification')
                        ->label(__('app.identification'))
                        ->searchable(),
                    Tables\Columns\TextColumn::make('plate')
                        ->label(__('app.plate'))
                        ->searchable(),
                ])
            )
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions(
                \App\Filament\Tables\Components\TableActions::getActions()
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(
                    \App\Filament\Tables\Components\TableActions::bulkActions()
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'view' => Pages\ViewVehicle::route('/{record}'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
