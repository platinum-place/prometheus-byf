<?php

namespace App\Filament\Resources\Customer\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Enums\Status;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ImportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Imports\Customer\ContactImporter;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Customer\ContactResource;
use Filament\Resources\RelationManagers\RelationManager;
use App\Filament\Imports\Customer\ContactRelationImporter;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';

    public static function getModelLabel(): string
    {
        return __('app.contact');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('app.contact');
    }

    public function form(Form $form): Form
    {
        return ContactResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                [],
                \App\Filament\Components\Tables\ContactTableColumns::contactColumns(),
            ))
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                ImportAction::make()
                    ->importer(ContactRelationImporter::class)
                    ->options(['customer_id' => $this->getOwnerRecord()->getKey()])
            ])
            ->actions(array_merge(
                [],
                \App\Filament\Components\Tables\TableActions::basicActions(),
            ))
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(array_merge(
                    [],
                    \App\Filament\Components\Tables\TableActions::bulkActions(),
                )),
            ]);
    }
}
