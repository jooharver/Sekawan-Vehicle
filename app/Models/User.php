<?php
namespace App\Models;

use Filament\Panel;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\Approval;
use App\Models\VehicleDriver;
use App\Models\AdminActivityLog;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'karyawan_id',
        'nik',
        'birth_date',
        'address',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Menambahkan logika untuk memeriksa role pengguna
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Menambahkan logika untuk memeriksa apakah pengguna adalah super admin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    /**
     * Event lifecycle: logging activity (created, updated, deleted)
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($model) {
            $changes = $model->getDirty(); // Menggunakan getDirty() untuk mengambil atribut yang diubah sebelum penyimpanan
            $original = $model->getOriginal(); // Mendapatkan nilai asli

            // Variabel untuk menyimpan data 'from' dan 'to' dengan tambahan kolom id_karyawan dan nama
            $from = [
                'id' => $original['id'],
                'name' => $original['name'],
            ];
            $to = [
                'id' => $model->id,
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

        //can't delete super admin
        static::deleting(function ($user) {
            if (in_array($user->id, [1, 2, 3])) {
                // Abort deletion
                throw new \Exception("User with ID {$user->id} cannot be deleted.");
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

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'approvals', 'id_approval');
    }

    public function drivers()
    {
        return $this->hasOne(Driver::class, 'user_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'requester_id','id');
    }

    public function approvalLevel1()
    {
        return $this->hasMany(Booking::class, 'approval_level_1', 'id');
    }

    public function approvalLevel2()
    {
        return $this->hasMany(Booking::class, 'approval_level_2', 'id');
    }


    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

}
