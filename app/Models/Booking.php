<?php

namespace App\Models;

use App\Models\User;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Approval;
use App\Models\UsageLog;
use App\Models\VehicleDriver;
use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'requester_id',
        'vehicle_id',
        'driver_id',
        'start_point',
        'end_point',
        'distance_km',
        'start_date',
        'end_date',
        'approval_level_1',
        'approval_level_2',
        'approval_status_1',
        'approval_status_2',
        'status',
        'notes'
    ];

    protected static function boot()
    {
        parent::boot();

        // Hook into the 'created' event
        static::created(function ($booking) {
            if($booking->requester_id == null){
                $booking->update([
                    'requester_id' => Auth::id(), // Menggunakan ID user yang sedang login
                ]);
            }
            // Update driver status to 'assigned'
            if ($booking->driver_id) {
                Driver::where('id_driver', $booking->driver_id)
                    ->update(['status' => 'assigned']);
            }

            // Update vehicle status to 'used'
            if ($booking->vehicle_id) {
                Vehicle::where('id_vehicle', $booking->vehicle_id)
                    ->update(['status' => 'used']);
            }

            // Buat data approvals untuk level 1 dan 2
            if ($booking->approval_level_1) {
                Approval::create([
                    'booking_id' => $booking->id_booking,
                    'approver_id' => $booking->approval_level_1,
                    'status' => 'pending',
                    'comments' => null,
                ]);
            }

            if ($booking->approval_level_2) {
                Approval::create([
                    'booking_id' => $booking->id_booking,
                    'approver_id' => $booking->approval_level_2,
                    'status' => 'pending',
                    'comments' => null,
                ]);
            }

            AdminActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'create',
                'from' => null, // Karena ini adalah penambahan
                'to' => json_encode($booking->getAttributes()),
            ]);

        });

        static::deleted(function ($model) {
            // Ubah status driver menjadi 'available'
            if ($model->driver_id) {
                Driver::where('id_driver', $model->driver_id)
                    ->update(['status' => 'available']);
            }

            // Ubah status vehicle menjadi 'available'
            if ($model->vehicle_id) {
                Vehicle::where('id_vehicle', $model->vehicle_id)
                    ->update(['status' => 'available']);
            }

            // Hapus data approval yang sesuai dengan approval_level_1 dan approval_level_2
            Approval::where('booking_id', $model->id_booking)
                ->whereIn('approver_id', [$model->approval_level_1, $model->approval_level_2])
                ->delete();

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

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id', 'id');
    }

    public function approvalLevel1()
    {
        return $this->belongsTo(User::class, 'approval_level_1', 'id');
    }

    public function approvalLevel2()
    {
        return $this->belongsTo(User::class, 'approval_level_2', 'id');
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class, 'approval_id', 'id_approval');
    }

    public function usageLog()
    {
        return $this->hasMany(UsageLog::class, 'booking_id', 'id_booking');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id_driver');
    }

}
