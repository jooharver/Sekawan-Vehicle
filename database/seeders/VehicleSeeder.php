<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'name' => 'Mitshubishi Fuso',
            'plate_number' => 'N 5071 EJD',
            'type' => 'angkutan barang',
            'fuel_consumption' => '8',
            'status' => 'available',
            'ownership' => 'owned',
            'photo_path' => 'vehicles/1.png',
        ]);

        Vehicle::create([
            'name' => 'Isuzu ELF N Series',
            'plate_number' => 'N 7089 JD',
            'type' => 'angkutan barang',
            'fuel_consumption' => '10',
            'status' => 'available',
            'ownership' => 'owned',
            'photo_path' => 'vehicles/2.png',
        ]);

        Vehicle::create([
            'name' => 'Hino Ranger Cargo FG',
            'plate_number' => 'N 8871 PDE',
            'type' => 'angkutan barang',
            'fuel_consumption' => '9',
            'status' => 'available',
            'ownership' => 'owned',
            'photo_path' => 'vehicles/3.png',
        ]);

        Vehicle::create([
            'name' => 'Toyota Hilux',
            'plate_number' => 'N 8481 GDE',
            'type' => 'angkutan barang',
            'fuel_consumption' => '10',
            'status' => 'available',
            'ownership' => 'owned',
            'photo_path' => 'vehicles/4.png',
        ]);

        Vehicle::create([
            'name' => 'Mitshubishi Pajero Sport',
            'plate_number' => 'N 1717 PE',
            'type' => 'angkutan orang',
            'fuel_consumption' => '11',
            'status' => 'available',
            'ownership' => 'owned',
            'photo_path' => 'vehicles/5.png',
        ]);

        Vehicle::create([
            'name' => 'Volvo FH16',
            'plate_number' => 'N 9051 SIE',
            'type' => 'angkutan barang',
            'fuel_consumption' => '8',
            'status' => 'available',
            'ownership' => 'owned',
            'photo_path' => 'vehicles/6.png',
        ]);

        Vehicle::create([
            'name' => 'Komatsu PC200',
            'plate_number' => 'N 1234 AIE',
            'type' => 'angkutan barang',
            'fuel_consumption' => '8',
            'status' => 'available',
            'ownership' => 'rented',
            'photo_path' => 'vehicles/7.png',
        ]);

        Vehicle::create([
            'name' => 'Toyota New Dyna',
            'plate_number' => 'N 4321 IED',
            'type' => 'angkutan barang',
            'fuel_consumption' => '9',
            'status' => 'available',
            'ownership' => 'owned',
            'photo_path' => 'vehicles/8.png',
        ]);

        Vehicle::create([
            'name' => 'Mitshubishi Fuso',
            'plate_number' => 'N 3326 EJD',
            'type' => 'angkutan barang',
            'fuel_consumption' => '8',
            'status' => 'available',
            'ownership' => 'owned',
            'photo_path' => 'vehicles/9.png',
        ]);

        Vehicle::create([
            'name' => 'Volvo FH16',
            'plate_number' => 'N 4056 SIE',
            'type' => 'angkutan barang',
            'fuel_consumption' => '8',
            'status' => 'available',
            'ownership' => 'owned',
            'photo_path' => 'vehicles/10.png',
        ]);

    }
}
