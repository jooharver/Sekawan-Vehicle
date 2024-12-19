<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateMaintenanceStatus extends Command
{
    protected $signature = 'maintenance:update-status';
    protected $description = 'Update maintenance status and vehicle availability based on completion_date';

    public function handle()
    {
        $currentDateTime = now();

        // Perbarui status Maintenance menjadi 'completed' jika completion_date terlewat
        $maintenances = DB::table('maintenance')
            ->where('status', '!=', 'completed')
            ->where('completion_date', '<=', $currentDateTime)
            ->get();

        foreach ($maintenances as $maintenance) {
            DB::table('maintenance')->where('id', $maintenance->id)->update(['status' => 'completed']);
            DB::table('vehicles')->where('id_vehicle', $maintenance->vehicle_id)->update(['status' => 'available']);
        }

        $this->info('Maintenance statuses and vehicles updated successfully.');
    }
}
