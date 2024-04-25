<?php

namespace App\Filament\Resources\Supplier\SupplierResource\RelationManagers;

use App\Enums\Supplier\ProductTypeEnum;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public static function getModelLabel(): string
    {
        return __('app.product');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('app.products');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('app.name'))
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label(__('app.price'))
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Select::make('type')
                    ->label(__('app.type'))
                    ->options(ProductTypeEnum::class)
                    ->required(),
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
                    Tables\Columns\TextColumn::make('price')
                        ->label(__('app.price'))
                        ->money()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('type')
                        ->label(__('app.type'))
                        ->searchable(),
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
