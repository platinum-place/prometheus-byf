<?php

namespace App\Filament\Resources\User\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\PermissionRegistrar;

class RolesRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';

    public static function getModelLabel(): string
    {
        return __('app.role');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('app.role');
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
                        ->label(__('app.name'))
                        ->searchable(),
                ])
            )
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->after(function () {
                        // Reset cached roles and permissions
                        app()[PermissionRegistrar::class]->forgetCachedPermissions();
                    }),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->after(function () {
                        // Reset cached roles and permissions
                        app()[PermissionRegistrar::class]->forgetCachedPermissions();
                    }),
            ])
            ->bulkActions([
                //
            ]);
    }
}
