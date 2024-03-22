<?php

namespace App\Filament\Schemas;

use App\Enums\Status;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;

class ContactForm
{
    public static function form($array = [])
    {
        return array_merge($array, [
            Section::make()
                ->columns(2)
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
                ]),
        ]);
    }
}
