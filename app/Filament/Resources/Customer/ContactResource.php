<?php

namespace App\Filament\Resources\Customer;

use App\Filament\Resources\Customer\ContactResource\Pages;
use App\Models\Customer\Contact;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;

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
            ->schema(
                \App\Filament\Schemas\ContactForm::form([
                    Section::make()
                        ->columns(2)
                        ->schema([
                            Select::make('customer_id')
                                ->label(__('app.customer'))
                                ->relationship(name: 'customer', titleAttribute: 'name')
                                ->searchable()
                        ]),
                ]),
            );
    }

    public static function table(Table $table, bool $relation_manager = false, ?int $owner_id = null): Table
    {
        return $table
            ->columns(
                \App\Filament\Columns\ContactColumns::columns([
                    Tables\Columns\TextColumn::make('id')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('customer.name')
                        ->label(__('app.customer'))
                        ->searchable(),
                ])
            )
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                //
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
