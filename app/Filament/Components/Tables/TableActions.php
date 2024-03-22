<?php

namespace App\Filament\Components\Tables;

use Filament\Tables;

class TableActions
{
    public static function basicActions()
    {
        return [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\ForceDeleteAction::make(),
            Tables\Actions\RestoreAction::make(),
        ];
    }

    public static function tabletAtDates()
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->label(__('app.created_at'))
                ->dateTime('d/m/Y h:i A')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->label(__('app.updated_at'))
                ->dateTime('d/m/Y h:i A')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('deleted_at')
                ->label(__('app.deleted_at'))
                ->dateTime('d/m/Y h:i A')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    public static function bulkActions()
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
            Tables\Actions\ForceDeleteBulkAction::make(),
            Tables\Actions\RestoreBulkAction::make(),
        ];
    }
}
