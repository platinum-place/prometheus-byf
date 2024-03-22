<?php

namespace App\Filament\Resources\Customer;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\Status;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Customer\CustomerResource\Pages;
use App\Filament\Resources\Customer\CustomerResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Forms\Components\Section;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('app.customer');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.customers');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('app.customers');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                \App\Filament\Schemas\ContactForm::form([
                    Section::make()
                        ->columns(2)
                        ->schema([
                            Forms\Components\TextInput::make('identification')
                                ->label(__('app.identification'))
                                ->required()
                                ->maxLength(255),
                        ])
                ]),
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                \App\Filament\Columns\ContactColumns::columns([
                    Tables\Columns\TextColumn::make('identification')
                        ->label(__('app.identification'))
                        ->searchable(),
                ])
            )
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions(
                \App\Filament\Actions\BaseTableActions::actions()
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(
                    \App\Filament\Actions\BaseTableActions::bulkActions()
                ),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ContactsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
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
