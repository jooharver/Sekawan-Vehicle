<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superRole = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superRole->givePermissionTo(['View Posts', 'Create Posts', 'Edit Posts', 'Delete Posts']);

        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(['View Posts', 'Create Posts', 'Edit Posts', 'Delete Posts']);

        $karyawanRole = Role::create(['name' => 'Driver', 'guard_name' => 'web']);
        $karyawanRole->givePermissionTo(['View Posts']);
    }
}
