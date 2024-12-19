<?php

namespace App\Filament\Admin\Resources\MaintenanceResource\Pages;

use App\Filament\Admin\Resources\MaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaintenance extends CreateRecord
{
    protected static string $resource = MaintenanceResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
