<?php

namespace App\Filament\Admin\Resources\UsageLogResource\Pages;

use App\Filament\Admin\Resources\UsageLogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUsageLog extends CreateRecord
{
    protected static string $resource = UsageLogResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
