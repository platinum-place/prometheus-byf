<?php

namespace App\Filament\Resources\Customer;

use App\Filament\Resources\Customer\ContactResource\Pages;
use App\Filament\Resources\Customer\ContactResource\RelationManagers;
use App\Models\Customer\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\Status;
use App\Filament\Imports\Customer\ContactImporter;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Model;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('app.contact');
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
                \App\Filament\Schemas\ContactForm::form(),
            );
    }

    public static function table(Table $table, bool $relation_manager = false, int $owner_id = null): Table
    {
        return $table
            ->columns(
                \App\Filament\Columns\ContactColumns::columns()
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
