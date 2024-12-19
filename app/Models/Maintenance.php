<?php

namespace App\Models;

use App\Models\Vehicle;
use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenances';
    protected $primaryKey = 'id_maintenance';

    protected $fillable = [
        'vehicle_id',
        'description',
        'scheduled_date',
        'completion_date',
        'cost',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        // Saat data Maintenance dibuat
        static::creating(function ($maintenance) {
            if ($maintenance->status === 'maintenance' && $maintenance->vehicle_id) {
                $vehicle = Vehicle::find($maintenance->vehicle_id);
                if ($vehicle) {
                    $vehicle->status = 'maintenance';
                    $vehicle->save();
                }
            }
        });

        static::updated(function ($model) {
            $changes = $model->getDirty(); // Menggunakan getDirty() untuk mengambil atribut yang diubah sebelum penyimpanan
            $original = $model->getOriginal(); // Mendapatkan nilai asli

            // Variabel untuk menyimpan data 'from' dan 'to' dengan tambahan kolom id_karyawan dan nama
            $from = [
                'id_maintenance' => $original['id_maintenance'],
            ];
            $to = [
                'id_maintenance' => $model->id_maintenance,
            ];

            foreach ($changes as $key => $value) {
                // Mengabaikan kolom 'tanggal_masuk' dan kolom timestamp
                if ($key !== 'tanggal_masuk' && !in_array($key, ['created_at', 'updated_at'])) {
                    // Menyimpan atribut yang diubah
                    $from[$key] = $original[$key];
                    $to[$key] = $value;
                }
            }

            if (!empty(array_diff_assoc($from, $to))) { // Pastikan hanya mencatat jika ada perubahan yang relevan
                AdminActivityLog::create([
                    'user_id' => auth()->id(),
                    'action' => 'update',
                    'from' => json_encode($from), // Hanya atribut yang diubah
                    'to' => json_encode($to), // Hanya atribut yang diubah
                ]);
            }
        });

        static::updating(function ($maintenance) {

            $currentDateTime = now();

            // Jika status diubah menjadi 'maintenance'
            if ($maintenance->status === 'maintenance') {
                DB::table('vehicles')
                    ->where('id_vehicle', $maintenance->vehicle_id)
                    ->update(['status' => 'maintenance']);
            }

            // Jika status diubah menjadi 'pending'
            elseif ($maintenance->status === 'pending') {
                DB::table('vehicles')
                    ->where('id_vehicle', $maintenance->vehicle_id)
                    ->update(['status' => 'available']);
            }

            // Jika tanggal hari ini lebih besar dari completion_date atau status menjadi 'completed'
            elseif ($maintenance->completion_date <= $currentDateTime || $maintenance->status === 'completed') {
                $maintenance->status = 'completed';

                DB::table('vehicles')
                    ->where('id_vehicle', $maintenance->vehicle_id)
                    ->update(['status' => 'available']);
            }
        });


        static::deleted(function ($model) {
            AdminActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'delete',
                'from' => json_encode($model->getAttributes()), // Menyimpan semua data saat dihapus
                'to' => null, // Karena data ini dihapus
            ]);
        });


    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id_vehicle');
    }
}
