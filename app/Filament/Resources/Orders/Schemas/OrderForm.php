<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Number;
use Filament\Forms\Components\Hidden;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Order Informtion')
                            ->schema([
                                Select::make('user_id')
                                    ->label('Customer')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Select::make('payment_method')
                                    ->options([
                                        'khalti' => 'Khalti',
                                        'cod' => 'Cash on delivery'
                                    ])
                                    ->required(),

                                Select::make("payment_status")
                                    ->options([
                                        'pending' => 'pending',
                                        'paid' => 'paid',
                                        'failed' => 'failed'
                                    ])
                                    ->default('pending')
                                    ->required(),

                                ToggleButtons::make('status')
                                    ->inline()
                                    ->default('new')
                                    ->required()

                                    ->options([
                                        'new' => 'new',
                                        'processing' => 'processing',
                                        'shipped' => 'shipped',
                                        'delivered' => 'Delivered',
                                        'cancelled' => 'Cancelled'
                                    ])
                                    ->colors([
                                        'new' => 'info',
                                        'processing' => 'warning',
                                        'shipped' => 'success',
                                        'delivered' => 'success',
                                        'cancelled' => 'danger'
                                    ])
                                    ->icons([
                                        'new' => 'heroicon-m-sparkles',
                                        'processing' => 'heroicon-m-arrow-path',
                                        'shipped' => 'heroicon-m-truck',
                                        'delivered' => 'heroicon-m-check-badge',
                                        'cancelled' => 'heroicon-m-x-circle'
                                    ]),

                                Select::make('currency')
                                    ->options([
                                        'inr' => 'INR',
                                        'usd' => 'USD',
                                        'Rs' => "Rs",
                                        'eur' => 'EUR'
                                    ])
                                    ->default('Rs')
                                    ->required(),

                                Select::make('shipping_method')
                                    ->options([
                                        'Domestic' => [
                                            'standard' => 'Standard (3-5 days)',
                                            'express' => 'Express (1-2 days)',
                                            'overnight' => 'Overnight (Next Day)',
                                        ],
                                        'International' => [
                                            'international_standard' => 'International Standard (7-14 days)',
                                            'international_express' => 'International Express (3-5 days)',
                                        ],
                                        'Other' => [
                                            'pickup' => 'Store Pickup',
                                            'digital' => 'Digital Delivery',
                                        ],
                                    ])
                                    ->required()
                                    ->searchable()
                                    ->placeholder('Select shipping method'),

                                    TextInput::make('shipping_amount')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rs.'),

                                Textarea::make('notes')
                                    ->columnSpanFull()
                                    ->columns(2),

                                Section::make('OrderItems')
    ->schema([
        Repeater::make('items')
            ->relationship()
            ->schema([
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $price = Product::find($state)?->price ?? 0;
                        $set('unit_amount', $price);
                        // Don't set total_amount here yet, let quantity update handle it
                    })
                    ->required(),

                TextInput::make('quantity')
                    ->numeric()
                    ->required()
                    ->default(1)
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $unitAmount = $get('unit_amount') ?? 0;
                        $total = $state * $unitAmount;
                        $set('total_amount', $total);
                    })
                    ->minValue(1)
                    ->step(1)
                    ->helperText('Enter the quantity (minimum 1)'),

                TextInput::make('unit_amount')
                    ->numeric()
                    ->required()
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('total_amount')
                    ->numeric()
                    ->required()
                    ->reactive(),
            ])
            ->columns(4)
            ->live()
            ->afterStateUpdated(function (Get $get, Set $set) {
                // Update grand total whenever items change
                $total = collect($get('items') ?? [])
                    ->sum(fn ($item) => (float) ($item['total_amount'] ?? 0));
                $set('grand_total', $total);
            }),

        Placeholder::make('grand_total_display')
            ->label('Grand Total')
            ->content(function (Get $get) {
                $total = collect($get('items') ?? [])
                    ->sum(fn ($item) => (float) ($item['total_amount'] ?? 0));
                return 'Rs. ' . number_format($total, 2);
            }),

        Hidden::make('grand_total')
            ->dehydrated()
            ->dehydrateStateUsing(function (Get $get) {
                return collect($get('items') ?? [])
                    ->sum(fn ($item) => (float) ($item['total_amount'] ?? 0));
            }),
    ])



                            ])
                    ])->columnSpanFull()
            ]);
    }
}
