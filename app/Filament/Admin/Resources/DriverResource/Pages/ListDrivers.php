<?php

namespace App\Filament\Admin\Resources\DriverResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Admin\Resources\DriverResource;
use App\Filament\Admin\Resources\DriverResource\Widgets\StatsDriver;

class ListDrivers extends ListRecords
{
    protected static string $resource = DriverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            StatsDriver::class,
        ];
    }
}
