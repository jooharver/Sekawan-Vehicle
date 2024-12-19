<?php

namespace App\Filament\Admin\Resources\VehicleResource\Widgets;

use App\Models\Vehicle;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsVehicle extends BaseWidget
{
    protected function getStats(): array
    {
        // Menampilkan Todays Vehicles
        $todayVehicles = Vehicle::where('status', 'available')// Mengambil jumlah vehicle dengan start_date hari ini
        ->count();
        // Menampilkan Pending Vehicles (dengan start_date hari ini)
        $pendingVehicles = Vehicle::where('status', 'in_use')
            ->count();

        // Menampilkan Approved Vehicles (dengan start_date hari ini)
        $approvedVehicles = Vehicle::where('status', 'maintenance')
            ->count();

        return [
            Stat::make('Available', $todayVehicles)
            ->descriptionIcon('heroicon-o-shopping-bag'), // Menampilkan jumlah vehicle hari ini
            Stat::make('In Use', $pendingVehicles)
            ->descriptionIcon('heroicon-m-arrow-trending-up'), // Menampilkan jumlah vehicle pending hari ini
            Stat::make('Maintenance', $approvedVehicles)
            ->descriptionIcon('heroicon-m-arrow-trending-up'), // Menampilkan jumlah vehicle yang approved hari ini
        ];
    }
}
