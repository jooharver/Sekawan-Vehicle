<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::create([
            'user_id' => 6,
            'license_number' => '1222-0212-009811',
            'status' => 'available',
        ]);

        Driver::create([
            'user_id' => 7,
            'license_number' => '1222-0212-009812',
            'status' => 'available',
        ]);

        Driver::create([
            'user_id' => 8,
            'license_number' => '1222-0212-009813',
            'status' => 'available',
        ]);

        Driver::create([
            'user_id' => 9,
            'license_number' => '1222-0212-009814',
            'status' => 'available',
        ]);

        Driver::create([
            'user_id' => 10,
            'license_number' => '1222-0212-009815',
            'status' => 'available',
        ]);

        Driver::create([
            'user_id' => 11,
            'license_number' => '1222-0212-009816',
            'status' => 'available',
        ]);

        Driver::create([
            'user_id' => 12,
            'license_number' => '1222-0212-009817',
            'status' => 'available',
        ]);

        Driver::create([
            'user_id' => 13,
            'license_number' => '1222-0212-009818',
            'status' => 'available',
        ]);

        Driver::create([
            'user_id' => 14,
            'license_number' => '1222-0212-009819',
            'status' => 'available',
        ]);

        Driver::create([
            'user_id' => 15,
            'license_number' => '1222-0212-009820',
            'status' => 'available',
        ]);
        
        Driver::create([
            'user_id' => 16,
            'license_number' => '1222-0212-009821',
            'status' => 'assigned',
        ]);
    }
}
