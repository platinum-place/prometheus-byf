<?php

namespace App\Filament\Components\Forms;

use Filament\Forms;
use Filament\Tables;
use App\Enums\Status;
use Filament\Forms\Components\Select;

class ContactForm
{
    public static function basicForm()
    {
        return [
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
        ];
    }
}
