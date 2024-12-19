<?php

namespace App\Models;

use App\Models\User;
use App\Models\Booking;
use App\Models\AdminActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'drivers';
    protected $primaryKey = 'id_driver';

    protected $fillable = [
        'name',
        'phone',
        'license_number',
        'status',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            AdminActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'from' => null, // Karena ini adalah penambahan
                'to' => json_encode($model->getAttributes()),
            ]);
        });

        static::updated(function ($model) {
            $changes = $model->getDirty(); // Menggunakan getDirty() untuk mengambil atribut yang diubah sebelum penyimpanan
            $original = $model->getOriginal(); // Mendapatkan nilai asli

            // Variabel untuk menyimpan data 'from' dan 'to' dengan tambahan kolom id_karyawan dan nama
            $from = [
                'id_driver' => $original['id_driver'],
            ];
            $to = [
                'id_driver' => $model->id_driver,
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // user_id refers to id in users
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'booking_id', 'id_booking');
    }
}
