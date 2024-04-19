<?php

namespace App\Filament\Resources\Supplier;

use App\Filament\Resources\Supplier\AgentResource\Pages;
use App\Models\Supplier\Agent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('app.agent');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.agents');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('app.suppliers');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('app.name'))
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label(__('app.phone'))
                    ->tel(),
                Forms\Components\Select::make('supplier_id')
                    ->label(__('app.supplier'))
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
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
                    Tables\Columns\TextColumn::make('phone')
                        ->label(__('app.phone'))
                        ->searchable(),
                    Tables\Columns\TextColumn::make('supplier.name')
                        ->label(__('app.supplier'))
                        ->sortable(),
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
            'index' => Pages\ListAgents::route('/'),
            'create' => Pages\CreateAgent::route('/create'),
            'view' => Pages\ViewAgent::route('/{record}'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
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
