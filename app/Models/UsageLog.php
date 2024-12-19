<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\AdminActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsageLog extends Model
{
    use HasFactory;

    protected $table = 'usage_logs';
    protected $primaryKey = 'id_usagelog';

    protected $fillable = [
        'start_date',
        'end_date',
        'start_point',
        'end_point',
        'distance_km',
        'booking_id',
        'vehicle_id',
        'fuel_used',
    ];

    protected static function boot()
    {
        parent::boot();

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

    public function user()
    {
        return $this->belongsTo(User::class, 'requester_id', 'id');
    }


    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id_booking');
    }

}
