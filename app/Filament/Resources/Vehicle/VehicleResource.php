<?php

namespace App\Filament\Resources\Vehicle;

use App\Filament\Forms\Components\Vehicle\VehicleFormComponent;
use App\Filament\Resources\Vehicle\VehicleResource\Pages;
use App\Models\Vehicle\Vehicle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
            ->schema(
                VehicleFormComponent::getCreateForm()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                \App\Filament\Tables\Components\Columns::getDateColumns([
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
                \App\Filament\Tables\Components\Actions::getActions()
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(
                    \App\Filament\Tables\Components\Actions::bulkActions()
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
