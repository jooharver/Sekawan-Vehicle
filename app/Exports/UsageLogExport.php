<?php

namespace App\Exports;

use App\Models\UsageLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class UsageLogExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil semua data UsageLog dengan relasi kendaraan (vehicle)
        return UsageLog::with('vehicle')->get()->map(function ($usageLog, $key) {
            return [
                'No' => $key + 1, // Menambahkan nomor urut
                'Booking ID' => $usageLog->booking_id,
                'Vehicle Name' => optional($usageLog->vehicle)->name, // Mengambil nama kendaraan dari relasi
                'Plate Number' => optional($usageLog->vehicle)->plate_number, // Mengambil nomor plat kendaraan dari relasi
                'Start Point' => $usageLog->start_point,
                'End Point' => $usageLog->end_point,
                'Start Date' => $this->formatDate($usageLog->start_date),
                'End Date' => $this->formatDate($usageLog->end_date),
                'Distance (KM)' => $usageLog->distance_km,
                'Fuel Used (Liter)' => $usageLog->fuel_used,
            ];
        });
    }

    /**
     * Format tanggal menjadi format 'd-m-Y'.
     *
     * @param  string|Carbon  $date
     * @return string
     */
    private function formatDate($date)
    {
        // Pastikan kita memeriksa jika tanggalnya adalah objek Carbon
        return $date instanceof Carbon ? $date->format('d-m-Y') : $date;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No', // Kolom untuk nomor urut
            'Booking ID',
            'Vehicle Name',
            'Plate Number',
            'Start Point',
            'End Point',
            'Start Date',
            'End Date',
            'Distance (KM)',
            'Fuel Used (Liter)',
        ];
    }
}
