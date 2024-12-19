<?php

namespace Database\Seeders;

use App\Models\Approval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Approval::create([
            'booking_id' => 1,
            'approver_id' => 2,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 1,
            'approver_id' => 3,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 2,
            'approver_id' => 2,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 2,
            'approver_id' => 3,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 3,
            'approver_id' => 2,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 3,
            'approver_id' => 3,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 4,
            'approver_id' => 4,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 4,
            'approver_id' => 5,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 5,
            'approver_id' => 4,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 5,
            'approver_id' => 5,
            'status' => 'pending',
        ]);

        Approval::create([
            'booking_id' => 6,
            'approver_id' => 4,
            'status' => 'approved',
        ]);

        Approval::create([
            'booking_id' => 6,
            'approver_id' => 5,
            'status' => 'approved',
        ]);

        Approval::create([
            'booking_id' => 7,
            'approver_id' => 4,
            'status' => 'approved',
        ]);

        Approval::create([
            'booking_id' => 7,
            'approver_id' => 5,
            'status' => 'approved',
        ]);

        Approval::create([
            'booking_id' => 7,
            'approver_id' => 4,
            'status' => 'approved',
        ]);

        Approval::create([
            'booking_id' => 7,
            'approver_id' => 5,
            'status' => 'approved',
        ]);

        Approval::create([
            'booking_id' => 8,
            'approver_id' => 2,
            'status' => 'approved',
        ]);

        Approval::create([
            'booking_id' => 8,
            'approver_id' => 3,
            'status' => 'approved',
        ]);

    }
}
