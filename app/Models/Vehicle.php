<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\UsageLog;
use App\Models\Maintenance;
use App\Models\AdminActivityLog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    protected $primaryKey = 'id_vehicle';

    protected $fillable = [
        'name',
        'plate_number',
        'type',
        'capacity',
        'fuel_consumption',
        'status',
        'ownership',
        'photo_path',
    ];


   // Menambahkan event "boot" untuk memeriksa apakah file di-upload
   protected static function boot()
   {
       parent::boot();

       static::creating(function ($vehicle) {
           // Cek apakah ada foto yang diupload
           if ($vehicle->photo_path instanceof UploadedFile) {
               // Ambil nama file asli
               $vehicle->photo_path = $vehicle->photo_path->getClientOriginalName();
           }

       });

       static::updated(function ($model) {
        $changes = $model->getDirty(); // Menggunakan getDirty() untuk mengambil atribut yang diubah sebelum penyimpanan
        $original = $model->getOriginal(); // Mendapatkan nilai asli

        // Variabel untuk menyimpan data 'from' dan 'to' dengan tambahan kolom id_karyawan dan nama
        $from = [
            'id_vehicle' => $original['id_vehicle'],
            'name' => $original['name'],
        ];
        $to = [
            'id_vehicle' => $model->id_vehicle,
            'name' => $model->name,
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

       static::deleted(function ($model) {
        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'from' => json_encode($model->getAttributes()), // Menyimpan semua data saat dihapus
            'to' => null, // Karena data ini dihapus
        ]);
    });


   }

   public function getPhotoPathAttribute($value)
   {
       return asset('storage/' . $value);
   }


    public function maintenance(){
        return $this->hasMany(Maintenance::class, 'vehicle_id', 'id_vehicle');
    }

}
