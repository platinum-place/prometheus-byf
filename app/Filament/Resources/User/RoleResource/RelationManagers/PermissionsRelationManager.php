<?php

namespace App\Filament\Resources\User\RoleResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\PermissionRegistrar;

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';

    public static function getModelLabel(): string
    {
        return __('app.permission');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('app.permission');
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
