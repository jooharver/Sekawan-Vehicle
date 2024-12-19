<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Tambahkan ini
use App\Models\User; // Pastikan model User sudah ada
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = 'Super Admin';
        $admin = 'Admin';
        $driver = 'Driver';

        $user1 = User::create([
            'nik' => '3507123409813762',
            'birth_date' => '2003-10-07',
            'address' => 'Jl. Sudimoro 11',
            'phone' => '087870463683',
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin'), // Menggunakan Hash untuk menyimpan password
            'remember_token' => Str::random(60), // Menggunakan Str untuk generate remember_token
        ]);
        $user1->assignRole($admin);

        $user2 = User::create([
            'nik' => '35071234098665432',
            'birth_date' => '1992-10-07',
            'address' => 'Jl. Merdeka 01',
            'phone' => '087870465432',
            'name' => 'Akbar Faisal',
            'email' => 'akbar@email.com',
            'password' => Hash::make('akbar'), // Menggunakan Hash untuk menyimpan password
            'remember_token' => Str::random(60), // Menggunakan Str untuk generate remember_token
        ]);
        $user2->assignRole($superAdmin);

        $user3 = User::create([
            'nik' => '3507123409887539',
            'birth_date' => '1986-09-07',
            'address' => 'Jl. Cut Nyak Dien 09',
            'phone' => '087870409747',
            'name' => 'Budie Arie',
            'email' => 'budie@email.com',
            'password' => Hash::make('budie'), // Menggunakan Hash untuk menyimpan password
            'remember_token' => Str::random(60), // Menggunakan Str untuk generate remember_token
        ]);
        $user3->assignRole($superAdmin);

        $user4 = User::create([
            'nik' => '3507123409854217',
            'birth_date' => '1996-11-12',
            'address' => 'Jl. Kebangsaan 20',
            'phone' => '0878704098731',
            'name' => 'Ceisya Putri',
            'email' => 'ceisya@email.com',
            'password' => Hash::make('ceisya'), // Menggunakan Hash untuk menyimpan password
            'remember_token' => Str::random(60), // Menggunakan Str untuk generate remember_token
        ]);
        $user4->assignRole($superAdmin);

        $user5 = User::create([
            'nik' => '3507123409800975',
            'birth_date' => '1994-07-23',
            'address' => 'Jl. Diponegoro 05',
            'phone' => '087870466784',
            'name' => 'Doni Saputra',
            'email' => 'doni@email.com',
            'password' => Hash::make('doni'), // Menggunakan Hash untuk menyimpan password
            'remember_token' => Str::random(60), // Menggunakan Str untuk generate remember_token
        ]);
        $user5->assignRole($superAdmin);

        //driver

        $faker = Faker::create(); // Inisialisasi Faker

        for ($id = 6; $id <= 20; $id++) {
            // Generate random data
            $name = $faker->firstName;
            $nik = $faker->numerify('################'); // 16 digit NIK
            $birthdate = $faker->date('Y-m-d', '1998-12-31'); // Tanggal lahir sebelum 2005
            $address = $faker->address;
            $phone = $faker->phoneNumber;

            $user = User::create([
                'name' => $name,
                'email' => strtolower($name) . '@email.com', // Email sesuai nama
                'password' => Hash::make(strtolower($name)), // Password sesuai nama
                'remember_token' => Str::random(60), // Token acak
                'nik' => $nik,
                'birth_date' => $birthdate,
                'address' => $address,
                'phone' => $phone,
            ]);

            // Assign role 'Driver' to each created user
            $user->assignRole($driver);
        }



    }
}
