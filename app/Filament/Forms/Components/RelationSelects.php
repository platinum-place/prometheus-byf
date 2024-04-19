<?php

namespace App\Filament\Forms\Components;

use App\Filament\Forms\Components\Customer\ContactFormComponent;
use App\Models\Customer\Contact;
use App\Models\Supplier\Agent;
use App\Models\Supplier\Product;
use App\Models\Vehicle\VehicleModel;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Builder;

class RelationSelects
{
    public static function getCustomerContactForm($array = [])
    {
        return array_merge($array, [
            Grid::make()
                ->schema([
                    Forms\Components\Select::make('customer_id')
                        ->label(__('app.customer'))
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(
                            fn (Set $set) => $set('contact_id', '')
                        ),
                    Forms\Components\Select::make('contact_id')
                        ->label(__('app.contact'))
                        ->relationship(
                            'contact',
                            'name',
                            fn (Builder $query, Get $get) => $query->whereCustomerId($get('customer_id'))
                        )
                        ->searchable()
                        ->preload()
                        ->createOptionForm(
                            ContactFormComponent::getSubCreateForm()
                        )
                        ->createOptionUsing(function (array $data, Get $get): int {
                            return Contact::create(array_merge($data, ['customer_id' => $get('customer_id')]))->getKey();
                        })
                        ->afterStateHydrated(function (Select $component, string $state) {
                            $component->state(Contact::find($state)->name);
                        })
                        ->required(),
                ]),
        ]);
    }

    public static function getVehicleMakeModelForm($array = [])
    {
        return array_merge($array, [
            Grid::make()
                ->schema([
                    Forms\Components\Select::make('vehicle_make_id')
                        ->label(__('app.make'))
                        ->relationship('vehicleMake', 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(
                            fn (Set $set) => $set('vehicle_model_id', '')
                        )
                        ->required(),
                    Forms\Components\Select::make('vehicle_model_id')
                        ->label(__('app.model'))
                        ->relationship(
                            'vehicleModel',
                            'name',
                            fn (Builder $query, Get $get) => $query->whereVehicleMakeId($get('vehicle_make_id'))
                        )
                        ->afterStateHydrated(function (Select $component, string $state) {
                            $component->state(VehicleModel::find($state)->name);
                        })
                        ->searchable()
                        ->preload()
                        ->live()
                        ->required(),
                ]),
        ]);
    }

    public static function getSupplierAgentProductForm($array = [])
    {
        return array_merge($array, [
            Grid::make()
                ->schema([
                    Forms\Components\Select::make('supplier_id')
                        ->label(__('app.supplier'))
                        ->relationship('supplier', 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->afterStateUpdated(
                            function (Set $set) {
                                $set('product_id', '');
                                $set('agent_id', '');
                            }
                        )
                        ->required(),
                    Forms\Components\Select::make('agent_id')
                        ->label(__('app.agent'))
                        ->relationship(
                            'agent',
                            'name',
                            fn (Builder $query, Get $get) => $query->whereSupplierId($get('supplier_id'))
                        )
                        ->searchable()
                        ->preload()
                        ->afterStateHydrated(function (Select $component, string $state) {
                            $component->state(Agent::find($state)->name);
                        })
                        ->required(),
                    Forms\Components\Select::make('product_id')
                        ->label(__('app.product'))
                        ->relationship(
                            'product',
                            'name',
                            fn (Builder $query, Get $get) => $query->whereSupplierId($get('supplier_id'))
                        )
                        ->searchable()
                        ->preload()
                        ->afterStateHydrated(function (Select $component, string $state) {
                            $component->state(Product::find($state)->name);
                        })
                        ->required(),
                ]),
        ]);
    }
}
