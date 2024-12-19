<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Maintenance::create([
            'vehicle_id' => 1,
            'description' => 'servis rutin',
            'scheduled_date' => '2024-12-31',
            'status' => 'pending',
        ]);

        Maintenance::create([
            'vehicle_id' => 2,
            'description' => 'servis rutin',
            'scheduled_date' => '2024-12-31',
            'status' => 'pending',
        ]);

        Maintenance::create([
            'vehicle_id' => 3,
            'description' => 'servis rutin',
            'scheduled_date' => '2024-12-24',
            'status' => 'pending',
        ]);

        Maintenance::create([
            'vehicle_id' => 4,
            'description' => 'servis rutin',
            'scheduled_date' => '2024-12-24',
            'status' => 'pending',
        ]);

        Maintenance::create([
            'vehicle_id' => 5,
            'description' => 'servis rutin',
            'scheduled_date' => '2024-12-31',
            'status' => 'pending',
        ]);

        Maintenance::create([
            'vehicle_id' => 6,
            'description' => 'servis rutin',
            'scheduled_date' => '2024-12-17',
            'status' => 'pending',
        ]);

        Maintenance::create([
            'vehicle_id' => 7,
            'description' => 'servis rutin',
            'scheduled_date' => '2024-12-31',
            'status' => 'pending',
        ]);

        Maintenance::create([
            'vehicle_id' => 8,
            'description' => 'servis rutin',
            'scheduled_date' => '2024-12-17',
            'status' => 'pending',
        ]);

        Maintenance::create([
            'vehicle_id' => 9,
            'description' => 'servis rutin',
            'scheduled_date' => '2024-12-24',
            'status' => 'pending',
        ]);


        Maintenance::create([
            'vehicle_id' => 10,
            'description' => 'servis berat',
            'scheduled_date' => '2024-12-10',
            'completion_date' => '2024-12-11',
            'status' => 'completed',
        ]);

        Maintenance::create([
            'vehicle_id' => 10,
            'description' => 'servis berat',
            'scheduled_date' => '2025-01-10',
            'status' => 'pending',
        ]);

    }
}
