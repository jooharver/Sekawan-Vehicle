<?php

namespace App\Filament\Admin\Resources\ApprovalResource\Pages;

use App\Filament\Admin\Resources\ApprovalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateApproval extends CreateRecord
{
    protected static string $resource = ApprovalResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
