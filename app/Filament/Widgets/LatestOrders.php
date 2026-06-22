<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LatestOrders extends TableWidget
{
    protected int |string | array  $columnSpan = 'full';
    protected static ?int $sort=2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at','desc')


            ->columns([

                TextColumn::make('id')
                    ->label('Order Id')
                    ->searchable(),
                TextColumn::make('user.name')
                ->searchable(),
                 TextColumn::make('grand_total')
                    ->numeric()
                    ->prefix('Rs.')
                    ->sortable(),

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
                //
            ])
            ->recordActions([
                 Action::make('View Order')
                    ->url(fn(Order $record): string =>OrderResource::getUrl('edit',['record'=>$record]))
                    ->icon('heroicon-m-eye')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ])


            ]);
    }
}
