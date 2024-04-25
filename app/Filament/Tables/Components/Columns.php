<?php

namespace App\Filament\Tables\Components;

use Filament\Tables;

class Columns
{
    public static function getDateColumns($array = [])
    {
        return array_merge([
            Tables\Columns\TextColumn::make('id')
                ->label('#')
                ->sortable()
                ->searchable(),
        ], $array, [
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
        ]);
    }
}
