<?php

namespace App\Filament\Admin\Resources\MaintenanceResource\Pages;

use App\Filament\Admin\Resources\MaintenanceResource;
use App\Filament\Admin\Resources\MaintenanceResource\Widgets\StatsMaintenance;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaintenances extends ListRecords
{
    protected static string $resource = MaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsMaintenance::class,
        ];
    }
}
