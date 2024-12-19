<?php

namespace App\Models;

use App\Models\User;
use App\Models\Booking;
use App\Models\AdminActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Approval extends Model
{
    use HasFactory;

    protected $table = 'approvals';
    protected $primaryKey = 'id_approval';

    protected $fillable = [
        'booking_id',
        'request_id',
        'approver_id',
        'level',
        'status',
        'comments',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event 'updated' untuk sinkronisasi status
        static::updated(function ($approval) {
            $booking = Booking::find($approval->booking_id);

            if ($booking) {
                // Cek level approval untuk update status yang sesuai
                if ($approval->approver_id == $booking->approval_level_1) {
                    $booking->update([
                        'approval_status_1' => $approval->status,
                    ]);
                } elseif ($approval->approver_id == $booking->approval_level_2) {
                    $booking->update([
                        'approval_status_2' => $approval->status,
                    ]);
                }
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


    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id_booking');
    }


    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
