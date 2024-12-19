<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Absen; // Import model Absen
use Illuminate\Support\Facades\DB;

class LineChart extends ChartWidget
{
    protected static ?string $heading = 'Rekap Kehadiran Tahun 2024';


    protected function getType(): string
    {
        return 'line'; // Menggunakan line chart
    }

    protected function getData(): array
    {
        // Data dummy untuk Januari hingga Desember
        $months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];
        // Data lebih dinamis untuk menghasilkan overlap
        $blueData = [30, 45, 60, 50, 80, 60, 70, 90, 60, 85, 75, 90]; // Line warna biru
        $greenData = [50, 65, 60, 55, 65, 65, 70, 55, 65, 85, 55, 45]; // Line warna hijau (overlap di beberapa titik)

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
