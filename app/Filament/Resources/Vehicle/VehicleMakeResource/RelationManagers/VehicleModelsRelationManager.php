<?php

namespace App\Filament\Resources\Vehicle\VehicleMakeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleModelsRelationManager extends RelationManager
{
    protected static string $relationship = 'vehicleModels';

    public static function getModelLabel(): string
    {
        return __('app.model');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('app.model');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('app.name'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(
                \App\Filament\Tables\Components\Columns::getDateColumns([
                    Tables\Columns\TextColumn::make('name')
                        ->label(__('app.name')),
                ])
            )
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions(
                \App\Filament\Tables\Components\Actions::getActions()
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(
                    \App\Filament\Tables\Components\Actions::bulkActions()
                ),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]));
    }
}
