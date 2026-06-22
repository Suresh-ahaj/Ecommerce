<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2) // Set form to 2 columns at root level
            ->components([
                // LEFT COLUMN - Product Information & Images
                Group::make()
                    ->columnSpan(1) // Takes left column
                    ->schema([
                        Section::make('📦 Product Information')
                            ->collapsible()
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur:true)
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->placeholder('Enter product name'),
                                TextInput::make('slug')
                                    ->required()
                                    ->placeholder('Enter URL slug')
                                    ->helperText('Unique URL identifier for the product'),
                                RichEditor::make('description')
                                    ->required()
                                    ->label('Description')
                                    ->columnSpanFull(),
                            ])
                            ->columns(1),

                        Section::make('🖼️ Images')
                            ->collapsible()
                            ->schema([
                                FileUpload::make('image')
                                    ->multiple()
                                    ->directory('products')
                                    ->reorderable()
                                    ->required()
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->helperText('Upload product images (max 2MB each)'),
                            ]),
                    ]),

                // RIGHT COLUMN - Pricing, Associations & Status
                Group::make()
                    ->columnSpan(1) // Takes right column
                    ->schema([
                        Section::make('💰 Pricing')
                            ->collapsible()
                            ->schema([
                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rs.')

                                    ->placeholder('0.00'),
                            ]),

                        Section::make('🔗 Associations')
                            ->collapsible()
                            ->schema([
                                Select::make('category_id')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->relationship('category', 'name')
                                    ->placeholder('Select a category'),
                                Select::make('brand_id')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->relationship('brand', 'name')
                                    ->placeholder('Select a brand'),
                            ])
                            ->columns(2),

                        Section::make('⚡ Status')
                            ->collapsible()
                            ->schema([
                                Toggle::make('is_active')
                                    ->default(true)
                                    ->required()
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->label('Active'),
                                Toggle::make('is_featured')
                                    ->required()
                                    ->onColor('warning')
                                    ->offColor('gray')
                                    ->label('Featured'),
                                Toggle::make('in_stock')
                                    ->default(true)
                                    ->required()
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->label('In Stock'),
                                Toggle::make('on_sale')
                                    ->required()
                                    ->onColor('primary')
                                    ->offColor('gray')
                                    ->label('On Sale'),
                            ])
                            ->columns(2),
                    ]),
            ]);
    }
}
