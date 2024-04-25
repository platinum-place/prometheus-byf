<?php

namespace App\Filament\Resources\Vehicle;

use App\Filament\Resources\Vehicle\VehicleMakeResource\Pages;
use App\Filament\Resources\Vehicle\VehicleMakeResource\RelationManagers;
use App\Models\Vehicle\VehicleMake;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleMakeResource extends Resource
{
    protected static ?string $model = VehicleMake::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function getModelLabel(): string
    {
        return __('app.make');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.makes');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('app.vehicles');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('app.name'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                \App\Filament\Tables\Components\Columns::getDateColumns([
                    Tables\Columns\TextColumn::make('name')
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
            RelationManagers\VehicleModelsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleMakes::route('/'),
            'create' => Pages\CreateVehicleMake::route('/create'),
            'view' => Pages\ViewVehicleMake::route('/{record}'),
            'edit' => Pages\EditVehicleMake::route('/{record}/edit'),
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
