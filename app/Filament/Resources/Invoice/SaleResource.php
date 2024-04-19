<?php

namespace App\Filament\Resources\Invoice;

use App\Enums\Invoice\SaleTypeEnum;
use App\Filament\Forms\Components\RelationSelects;
use App\Filament\Forms\Components\Vehicle\VehicleFormComponent;
use App\Filament\Resources\Invoice\SaleResource\Pages;
use App\Models\Invoice\Sale;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('app.sale');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.sales');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('app.invoices');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('app.general_info'))
                    ->description(__('app.general_info_description'))
                    ->schema(
                        RelationSelects::getCustomerContactForm([
                            Select::make('type')
                                ->label(__('app.type'))
                                ->options(SaleTypeEnum::class)
                                ->live()
                                ->required(),
                        ])
                    )
                    ->columns(),
                Section::make(__('app.supplier_info'))
                    ->description(__('app.supplier_info_description'))
                    ->schema(
                        RelationSelects::getSupplierAgentProductForm()
                    )
                    ->columns(),
                Section::make(__('app.vehicle_section'))
                    ->description(__('app.vehicle_section_description'))
                    ->schema([
                        Forms\Components\Textarea::make('site_a')
                            ->label(__('app.site_a'))
                            ->required(),
                        Forms\Components\Textarea::make('site_b')
                            ->label(__('app.site_b')),
                        Forms\Components\Select::make('vehicle_id')
                            ->label(__('app.vehicle').' ('.__('app.chassis').')')
                            ->relationship('vehicle', 'chassis')
                            ->searchable()
                            ->preload()
                            ->createOptionForm(
                                VehicleFormComponent::getSubCreateForm()
                            )
                            ->required(),
                    ])
                    ->columns()
                    ->hidden(fn (Get $get) => $get('type') != SaleTypeEnum::vehicle->value),
                Forms\Components\Textarea::make('note')
                    ->label(__('app.note'))
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                \App\Filament\Tables\Components\Columns::getDateColumns([
                    Tables\Columns\TextColumn::make('supplier.name')
                        ->label(__('app.supplier'))
                        ->sortable(),
                    Tables\Columns\TextColumn::make('contact.name')
                        ->label(__('app.contact'))
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('type')
                        ->label(__('app.type'))
                        ->searchable(),

                    /**
                     * Vehicle
                     */
                    Tables\Columns\TextColumn::make('vehicle.chassis')
                        ->label(__('app.vehicle').' ('.__('app.chassis').')')
                        ->toggleable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('site_a')
                        ->label(__('app.site_a'))
                        ->toggleable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('site_b')
                        ->label(__('app.site_b'))
                        ->toggleable()
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'view' => Pages\ViewSale::route('/{record}'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
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
