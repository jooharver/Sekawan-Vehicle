<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;

class PieChart extends ChartWidget
{
    protected static ?string $heading = 'Kendaraan Tersedia';

    protected function getType(): string
    {
        return 'pie'; // Menggunakan pie chart
    }

    protected function getData(): array
    {
        // Dummy data
        $available = 65; // Kendaraan yang tersedia
        $assigned = 40;  // Kendaraan yang sedang digunakan

        return [
            'labels' => ['Available', 'Assigned'], // Label untuk setiap bagian
            'datasets' => [
                [
                    'data' => [$available, $assigned], // Persentase data
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.8)', // Warna hijau untuk Available
                        'rgba(255, 99, 132, 0.8)', // Warna merah untuk Assigned
                    ],
                    'hoverBackgroundColor' => [
                        'rgba(75, 192, 192, 1)', // Warna hijau lebih terang
                        'rgba(255, 99, 132, 1)', // Warna merah lebih terang
                    ],
                ],
            ],
        ];
    }
}
