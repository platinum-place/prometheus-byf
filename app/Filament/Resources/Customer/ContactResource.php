<?php

namespace App\Filament\Resources\Customer;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\Customer\Contact;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Customer\ContactResource\Pages;
use App\Filament\Resources\Customer\ContactResource\RelationManagers;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return Str::lower(__('app.contact'));
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.contacts');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('app.customers');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->label(__('app.customer'))
                    ->searchable()
                    ->relationship('customer', 'name'),
                Forms\Components\TextInput::make('name')
                    ->label(__('app.name'))
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label(__('app.phone'))
                    ->tel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                \App\Filament\Tables\Components\TableColumns::getDateColumns([
                    Tables\Columns\TextColumn::make('name')
                        ->label(__('app.name'))
                        ->searchable(),
                    Tables\Columns\TextColumn::make('customer.name')
                        ->label(__('app.customer'))
                        ->sortable(),
                ])
            )
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions(
                \App\Filament\Tables\Components\TableActions::getActions()
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(
                    \App\Filament\Tables\Components\TableActions::bulkActions()
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
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
