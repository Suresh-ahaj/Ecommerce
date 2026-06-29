<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()

                    ->schema([
                        Select::make('parent_id')
                            ->label('Parent Category')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->placeholder('Main Category'),
                        TextInput::make('name')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->required(),
                        TextInput::make('slug')
                            ->unique(Category::class, ignoreRecord: true)
                            ->required(),
                        FileUpload::make('image')
                            ->image()
                            ->directory('categories'),
                        Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
    // tree structure ma dekhauxa
    protected static function getCategoryOptions($categories, $prefix = '')
    {
        $options = [];

        foreach ($categories as $category) {
            $options[$category->id] = $prefix . $category->name;

            if ($category->children->count()) {
                $options += static::getCategoryOptions(
                    $category->children,
                    $prefix . '└── '
                );
            }
        }

        return $options;
    }
}
