<?php

namespace App\Filament\Admin\Resources\BookingResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Booking; // Pastikan untuk menggunakan model Booking

class StatsBooking extends BaseWidget
{
    protected function getStats(): array
    {
        // Menampilkan Todays Bookings
        $todayBookings = Booking::whereDate('start_date', today())->count(); // Mengambil jumlah booking dengan start_date hari ini

        // Menampilkan Pending Bookings (dengan start_date hari ini)
        $pendingBookings = Booking::where('approval_status_2', 'pending')
            ->whereDate('start_date', today()) // Menambahkan kondisi untuk start_date hari ini
            ->count();

        // Menampilkan Approved Bookings (dengan start_date hari ini)
        $approvedBookings = Booking::where('approval_status_2', 'approved')
            ->whereDate('start_date', today()) // Menambahkan kondisi untuk start_date hari ini
            ->count();

        return [
            Stat::make('Todays Bookings', $todayBookings)
            ->descriptionIcon('heroicon-o-shopping-bag'), // Menampilkan jumlah booking hari ini
            Stat::make('Pending Bookings', $pendingBookings)
            ->descriptionIcon('heroicon-m-arrow-trending-up'), // Menampilkan jumlah booking pending hari ini
            Stat::make('Approved Bookings', $approvedBookings)
            ->descriptionIcon('heroicon-m-arrow-trending-up'), // Menampilkan jumlah booking yang approved hari ini
        ];
    }
}
