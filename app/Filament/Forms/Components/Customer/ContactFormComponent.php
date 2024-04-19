<?php

namespace App\Filament\Forms\Components\Customer;

use Filament\Forms;
use Filament\Forms\Components\Grid;

class ContactFormComponent
{
    private static function getForm($array = [])
    {
        return array_merge($array, [
            Grid::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('app.name'))
                        ->live()
                        ->required(),
                    Forms\Components\TextInput::make('phone')
                        ->label(__('app.phone'))
                        ->tel(),
                    Forms\Components\TextInput::make('identification')
                        ->label(__('app.identification')),
                ]),
        ]);
    }

    public static function getCreateForm($array = [])
    {
        return array_merge($array, self::getForm([
            Grid::make()
                ->schema([
                    Forms\Components\Select::make('customer_id')
                        ->label(__('app.customer'))
                        ->searchable()
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->preload(),
                ]),
        ]));
    }

    public static function getSubCreateForm($array = [])
    {
        return array_merge($array, static::getForm());
    }

    public static function getCreateRelationForm($array = [])
    {
        return array_merge($array, static::getForm());
    }
}
