<?php

namespace App\Filament\Resources\Orders\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', 'new')->count())
                ->description('Recent orders')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('info')
                ->chart([7, 3, 10, 5, 8, 12, 4]),

            Stat::make('Processing', Order::query()->where('status', 'processing')->count())
                ->description('In progress')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning')
                ->chart([4, 6, 8, 3, 7, 5, 9]),

            Stat::make('Shipped', Order::query()->where('status', 'shipped')->count())
                ->description('On the way')
                ->descriptionIcon('heroicon-m-truck')
                ->color('success')
                ->chart([2, 5, 3, 8, 4, 6, 7]),

            Stat::make('Average Price', Number::currency(Order::query()->avg('grand_total') ?? 0, 'NPR'))
                ->description('Per order')
                ->descriptionIcon('heroicon-m-currency-rupee')
                ->color('primary')
                ->chart([100, 120, 90, 150, 130, 110, 140]),
        ];
    }

    // Optional: Configure columns for different breakpoints
    protected function getColumns(): int | array
    {
        return [
            'default' => 1,  // 1 column on mobile
            'sm' => 2,       // 2 columns on small screens
            'md' => 2,       // 2 columns on medium screens
            'lg' => 3,       // 3 columns on large screens
            'xl' => 4,       // 4 columns on extra large screens
            '2xl' => 4,      // 4 columns on 2xl screens
        ];
    }
}
