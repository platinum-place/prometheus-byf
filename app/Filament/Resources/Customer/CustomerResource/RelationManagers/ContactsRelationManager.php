<?php

namespace App\Filament\Resources\Customer\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Enums\Status;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ImportAction;
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
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('app.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label(__('app.phone'))
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->label(__('app.status'))
                    ->options(Status::class)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('app.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('app.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label(__('app.status')),
            ])
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
                \App\Filament\Tables\Actions::getActions()
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(
                    \App\Filament\Tables\Actions::bulkActions()
                ),
            ]);
    }
}
