<?php

namespace App\Filament\Columns;

use Filament\Forms;
use Filament\Tables;
use App\Enums\Status;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;

class ContactColumns
{
    public static function columns($array = [])
    {
        return array_merge(
            $array,
            \App\Filament\Columns\DateAtColumns::columns([
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
        );
    }
}
