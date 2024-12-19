<?php

namespace Database\Seeders;

use App\Models\UsageLog;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsageLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsageLog::create([
            'vehicle_id' => 6,
            'booking_id' => 6,
            'start_point' => 'SM 02',
            'end_point' => 'SM 01',
            'distance_km' => 5,
            'start_date' => '2024-12-10',
            'end_date' => '2024-12-11',
            'fuel_used' => 5,
        ]);

        UsageLog::create([
            'vehicle_id' => 1,
            'booking_id' => 7,
            'start_point' => 'SM 02',
            'end_point' => 'SM 01',
            'distance_km' => 34,
            'start_date' => '2024-12-12',
            'end_date' => '2024-12-13',
            'fuel_used' => 5,
        ]);

        UsageLog::create([
            'vehicle_id' => 9,
            'booking_id' => 8,
            'start_point' => 'SM 01',
            'end_point' => 'SM 06',
            'distance_km' => 78,
            'start_date' => '2024-12-11',
            'end_date' => '2024-12-13',
            'fuel_used' => 10,
        ]);
    }
}
