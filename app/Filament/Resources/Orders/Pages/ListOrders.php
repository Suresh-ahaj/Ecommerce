<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Filament\Resources\Orders\Widgets\OrderStats;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Override;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    #[Override]
    protected function getHeaderWidgets(): array
    {
    return [
        OrderStats::class
    ];
    }

    //
    #[Override]
    public function getTabs(): array
    {
        return [
            null=>Tab::make("All"),
            'processing'=>Tab::make()->query(fn($query)=>$query->where('status','processing')),
            'shipped'=>Tab::make()->query(fn($query)=>$query->where('status','shipped')),
            'delivered'=>Tab::make()->query(fn($query)=>$query->where('status','delivered')),
            'cancelled'=>Tab::make()->query(fn($query)=>$query->where('status','cancelled')),
        ];
    }
}
