<?php

namespace App\Filament\Admin\Resources\MaintenanceResource\Widgets;

use Carbon\Carbon;
use App\Models\Maintenance;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsMaintenance extends BaseWidget
{
    protected function getStats(): array
    {
        // Mendapatkan bulan dan tahun sekarang
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Menampilkan Driver in Maintenance this Month
        $maintenanceThisMonth = Maintenance::whereMonth('scheduled_date', $currentMonth)
            ->whereYear('scheduled_date', $currentYear)
            ->where('status', 'completed')
            ->count(); // Mengambil jumlah driver yang dalam pemeliharaan pada bulan ini

        // Menampilkan Pending Drivers this Month
        $pendingThisMonth = Maintenance::whereMonth('scheduled_date', $currentMonth)
            ->whereYear('scheduled_date', $currentYear)
            ->where('status', 'pending')
            ->count(); // Mengambil jumlah driver yang statusnya pending pada bulan ini

        // Menampilkan Drivers Under Maintenance this Month
        $underMaintenanceThisMonth = Maintenance::whereMonth('scheduled_date', $currentMonth)
            ->whereYear('scheduled_date', $currentYear)
            ->where('status', 'under maintenance')
            ->count(); // Mengambil jumlah driver yang statusnya dalam pemeliharaan pada bulan ini

        return [
            Stat::make('Pending This Month', $pendingThisMonth)
                ->descriptionIcon('heroicon-o-clock'),
            Stat::make('Under Maintenance This Month', $underMaintenanceThisMonth)
                ->descriptionIcon('heroicon-o-wrench'),
            Stat::make('Completed This Month', $maintenanceThisMonth)
                ->descriptionIcon('heroicon-o-wrench'),

        ];
    }
}
