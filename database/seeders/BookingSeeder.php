<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            'id_booking' => 1,
            'requester_id' => 1,
            'vehicle_id' => 1,
            'driver_id' => 1,
            'start_point' => 'SM 01',
            'end_point' => 'SM 02',
            'distance_km' => 34,
            'start_date' => '2024-12-14',
            'end_date' => '2024-12-14',
            'approval_level_1' => 2,
            'approval_level_2' => 3,
            'approval_status_1' => 'pending',
            'approval_status_2' => 'pending',
            'notes' => 'Pick up mentahan nikel'
        ]);

        Booking::create([
            'id_booking' => 2,
            'requester_id' => 1,
            'vehicle_id' => 2,
            'driver_id' => 2,
            'start_point' => 'SM 01',
            'end_point' => 'SM 03',
            'distance_km' => 45,
            'start_date' => '2024-12-14',
            'end_date' => '2024-12-15',
            'approval_level_1' => 2,
            'approval_level_2' => 3,
            'approval_status_1' => 'pending',
            'approval_status_2' => 'pending',
            'notes' => 'Pick up mentahan nikel'
        ]);

        Booking::create([
            'id_booking' => 3,
            'requester_id' => 1,
            'vehicle_id' => 3,
            'driver_id' => 3,
            'start_point' => 'SM 01',
            'end_point' => 'SM 04',
            'distance_km' => 56,
            'start_date' => '2024-12-14',
            'end_date' => '2024-12-16',
            'approval_level_1' => 2,
            'approval_level_2' => 3,
            'approval_status_1' => 'pending',
            'approval_status_2' => 'pending',
            'notes' => 'Pick up mentahan nikel'
        ]);

        Booking::create([
            'id_booking' => 4,
            'requester_id' => 1,
            'vehicle_id' => 4,
            'driver_id' => 4,
            'start_point' => 'SM 02',
            'end_point' => 'SM 03',
            'distance_km' => 34,
            'start_date' => '2024-12-14',
            'end_date' => '2024-12-14',
            'approval_level_1' => 4,
            'approval_level_2' => 5,
            'approval_status_1' => 'pending',
            'approval_status_2' => 'pending',
            'notes' => 'Pick up alat tambang'
        ]);

        Booking::create([
            'id_booking' => 5,
            'requester_id' => 1,
            'vehicle_id' => 5,
            'driver_id' => 5,
            'start_point' => 'SM 02',
            'end_point' => 'SM 05',
            'distance_km' => 64,
            'start_date' => '2024-12-14',
            'end_date' => '2024-12-16',
            'approval_level_1' => 4,
            'approval_level_2' => 5,
            'approval_status_1' => 'pending',
            'approval_status_2' => 'pending',
            'notes' => 'Pemantauan tambang oleh direktur'
        ]);
 //6
        Booking::create([
            'id_booking' => 6,
            'requester_id' => 1,
            'vehicle_id' => 6,
            'driver_id' => 6,
            'start_point' => 'SM 02',
            'end_point' => 'SM 01',
            'distance_km' => 34,
            'start_date' => '2024-12-10',
            'end_date' => '2024-12-11',
            'approval_level_1' => 4,
            'approval_level_2' => 5,
            'approval_status_1' => 'approved',
            'approval_status_2' => 'approved',
            'notes' => 'Pick up mentahan nikel'
        ]);

        Booking::create([
            'id_booking' => 7,
            'requester_id' => 1,
            'vehicle_id' => 7,
            'driver_id' => 1,
            'start_point' => 'SM 02',
            'end_point' => 'SM 01',
            'distance_km' => 34,
            'start_date' => '2024-12-12',
            'end_date' => '2024-12-13',
            'approval_level_1' => 4,
            'approval_level_2' => 5,
            'approval_status_1' => 'approved',
            'approval_status_2' => 'approved',
            'notes' => 'Pick up mentahan nikel'
        ]);

        Booking::create([
            'id_booking' => 8,
            'requester_id' => 1,
            'vehicle_id' => 8,
            'driver_id' => 3,
            'start_point' => 'SM 01',
            'end_point' => 'SM 06',
            'distance_km' => 78,
            'start_date' => '2024-12-11',
            'end_date' => '2024-12-13',
            'approval_level_1' => 2,
            'approval_level_2' => 3,
            'approval_status_1' => 'approved',
            'approval_status_2' => 'approved',
            'notes' => 'Pick up mentahan nikel'
        ]);

    }
}
