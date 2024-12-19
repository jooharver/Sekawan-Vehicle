<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Vehicle; // Pastikan model Vehicle sudah ada

class PieChart extends ChartWidget
{
    protected static ?string $heading = 'Kendaraan Tersedia';

    protected function getType(): string
    {
        return 'pie'; // Menggunakan pie chart
    }

    protected function getData(): array
    {
        // Hitung jumlah kendaraan berdasarkan status
        $availableCount = Vehicle::where('status', 'available')->count();
        $usedCount = Vehicle::where('status', 'used')->count();
        $maintenanceCount = Vehicle::where('status', 'maintenance')->count();

        return [
            'labels' => ['Available', 'Used', 'Maintenance'], // Label untuk setiap bagian
            'datasets' => [
                [
                    'data' => [$availableCount, $usedCount, $maintenanceCount], // Data dari database
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.8)', // Warna hijau untuk Available
                        'rgba(255, 99, 132, 0.8)', // Warna merah untuk Used
                        'rgba(255, 206, 86, 0.8)', // Warna kuning untuk Maintenance
                    ],
                    'hoverBackgroundColor' => [
                        'rgba(75, 192, 192, 1)', // Warna hijau lebih terang
                        'rgba(255, 99, 132, 1)', // Warna merah lebih terang
                        'rgba(255, 206, 86, 1)', // Warna kuning lebih terang
                    ],
                ],
            ],
        ];
    }
}
