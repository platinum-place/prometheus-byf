<?php

namespace App\Filament\Resources\Customer\CustomerResource\RelationManagers;

use App\Filament\Imports\Customer\ContactRelationImporter;
use App\Filament\Resources\Customer\ContactResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

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
            ->columns(
                \App\Filament\Columns\ContactColumns::columns()
            )
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                ImportAction::make()
                    ->importer(ContactRelationImporter::class)
                    ->options(['customer_id' => $this->getOwnerRecord()->getKey()]),
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
}
