<?php

namespace App\Filament\Admin\Resources\DriverResource\Widgets;

use App\Models\Driver;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsDriver extends BaseWidget
{
    protected function getStats(): array
    {
        // Menampilkan Total Driver
        $totalDrivers = Driver::distinct('id_driver')->count(); // Mengambil jumlah total driver yang ada berdasarkan id_driver

        // Menampilkan Pending Vehicles (dengan start_date hari ini)
        $avaDrivers = Driver::where('status', 'available')
            ->count();

        // Menampilkan Approved Vehicles (dengan start_date hari ini)
        $asgDrivers = Driver::where('status', 'assigned')
            ->count();

        return [
            Stat::make('Total Driver', $totalDrivers)
            ->descriptionIcon('heroicon-o-shopping-bag'), // Menampilkan jumlah vehicle hari ini
            Stat::make('Available', $avaDrivers)
            ->descriptionIcon('heroicon-m-arrow-trending-up'), // Menampilkan jumlah vehicle pending hari ini
            Stat::make('Assigned', $asgDrivers)
            ->descriptionIcon('heroicon-m-arrow-trending-up'), // Menampilkan jumlah vehicle yang approved hari ini
        ];
    }
}
