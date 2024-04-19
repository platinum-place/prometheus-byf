<?php

namespace App\Filament\Resources\Customer\CustomerResource\RelationManagers;

use App\Filament\Forms\Components\Customer\ContactFormComponent;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
            ->schema(
                ContactFormComponent::getCreateRelationForm()
            );
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns(
                \App\Filament\Tables\Components\Columns::getDateColumns([
                    Tables\Columns\TextColumn::make('name')
                        ->label(__('app.name')),
                    Tables\Columns\TextColumn::make('phone')
                        ->label(__('app.phone')),
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
