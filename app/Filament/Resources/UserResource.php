<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers as Role_RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('app.user');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.users');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('app.tools');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('app.name'))
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label(__('app.email'))
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label(__('app.password'))
                    ->password()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                \App\Filament\Tables\Components\Columns::getDateColumns([
                    Tables\Columns\TextColumn::make('name')
                        ->label(__('app.name'))
                        ->searchable(),
                    Tables\Columns\TextColumn::make('email')
                        ->label(__('app.email'))
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
            RelationManagers\RolesRelationManager::class,
            Role_RelationManagers\PermissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
