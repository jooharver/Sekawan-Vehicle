<?php

namespace App\Filament\Admin\Resources\VehicleResource\Pages;

use App\Filament\Admin\Resources\VehicleResource;
use App\Filament\Admin\Resources\VehicleResource\Widgets\StatsVehicle;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicles extends ListRecords
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsVehicle::class,
        ];
    }
}
