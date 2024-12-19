<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;

class PolarChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Pemakaian Kendaraan';

    protected function getType(): string
    {
        return 'polarArea'; // Menggunakan polar chart
    }

    protected function getData(): array
    {
        // Dummy data untuk jumlah pemakaian kendaraan
        $data = [
            'A' => 30, // Kendaraan A
            'B' => 45, // Kendaraan B
            'C' => 25, // Kendaraan C
            'D' => 40, // Kendaraan D
            'E' => 35, // Kendaraan E
        ];

        return [
            'labels' => array_keys($data), // Label kendaraan
            'datasets' => [
                [
                    'data' => array_values($data), // Data pemakaian kendaraan
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.8)', // Warna hijau
                        'rgba(255, 99, 132, 0.8)', // Warna merah
                        'rgba(54, 162, 235, 0.8)', // Warna biru
                        'rgba(255, 206, 86, 0.8)', // Warna kuning
                        'rgba(153, 102, 255, 0.8)', // Warna ungu
                    ],
                    'hoverBackgroundColor' => [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                ],
            ],
        ];
    }
}
