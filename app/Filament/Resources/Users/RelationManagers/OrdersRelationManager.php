<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Schema $schema): Schema
    {
        // return $schema
        // ->components([
        //     TextInput::make('staus'),
        //     TextInput::make('id')
        //         ->required()
        //         ->maxLength(255),
        // ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('grand_total')
                    ->numeric()
                    ->prefix('Rs.')
                    ->sortable(),

                TextColumn::make('id')
                    ->label('Order Id')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'info' => 'new',
                        'warning' => 'processing',
                        'success' => ['shipped', 'delivered'],
                        'danger' => 'cancelled',
                    ])
                    ->icons([
                        'heroicon-o-sparkles' => 'new',
                        'heroicon-o-arrow-path' => 'processing',
                        'heroicon-o-truck' => 'shipped',
                        'heroicon-o-check-circle' => 'delivered',
                        'heroicon-o-x-circle' => 'cancelled',
                    ])
                    ->sortable(),
                    TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),
                     TextColumn::make('payment_status')
                    ->sortable()
                    ->badge()
                    ->searchable(),
                     TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction::make(),
                // AssociateAction::make(),
            ])
           ->recordActions([
    DeleteAction::make(),

    Action::make('View Order')
                    ->url(fn(Order $record): string =>OrderResource::getUrl('edit',['record'=>$record]))
                    ->icon('heroicon-m-eye')
])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
