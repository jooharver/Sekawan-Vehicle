<?php

namespace App\Filament\Admin\Resources\BookingResource\Pages;

use App\Filament\Admin\Resources\BookingResource;
use App\Filament\Admin\Resources\BookingResource\Widgets\StatsBooking;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsBooking::class
        ];
    }

    // protected function getFooterWidgets(): array
    // {
    //     return [
    //         StatsBooking::class
    //     ];
    // }
}
