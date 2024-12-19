<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;

class BarChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pemakaian Kendaraan 2024';

    protected function getType(): string
    {
        return 'bar'; // Menggunakan bar chart
    }

    protected function getData(): array
    {
        // Data dummy untuk Januari hingga Desember
        $months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        $blueData = [30, 45, 60, 50, 80, 40, 70, 55, 65, 85, 75, 90]; // Data untuk bar warna biru
        $greenData = [25, 35, 55, 45, 75, 35, 65, 50, 60, 80, 70, 85]; // Data untuk bar warna hijau

        return [
            'labels' => $months, // Label sumbu X (bulan)
            'datasets' => [
                [
                    'label' => 'Owned Vehicle',
                    'data' => $blueData,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.7)', // Warna biru
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Rent vehicle',
                    'data' => $greenData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.7)', // Warna hijau
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}
