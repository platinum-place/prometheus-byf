<?php

namespace App\Filament\Components\Tables;

use Filament\Tables;

class ContactTableColumns
{
    public static function contactColumns()
    {
        return array_merge(
            [
                Tables\Columns\TextColumn::make('name')
                    ->label(__('app.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('app.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label(__('app.status')),
            ],
            \App\Filament\Components\Tables\TableActions::tabletAtDates(),
        );
    }
}
