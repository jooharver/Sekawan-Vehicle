<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddTriggerAfterUpdateApprovalOnBookings extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER after_update_approval
            AFTER UPDATE ON bookings
            FOR EACH ROW
            BEGIN
                -- Handle approval_level_1
                IF OLD.approval_level_1 != NEW.approval_level_1 THEN
                    -- Hapus data approval lama
                    DELETE FROM approvals
                    WHERE booking_id = OLD.id_booking
                      AND approver_id = OLD.approval_level_1;

                    -- Tambahkan data approval baru
                    IF NEW.approval_level_1 IS NOT NULL THEN
                        INSERT INTO approvals (booking_id, approver_id, status, comments, created_at, updated_at)
                        VALUES (NEW.id_booking, NEW.approval_level_1, "pending", NULL, NOW(), NOW());
                    END IF;
                END IF;

                -- Handle approval_level_2
                IF OLD.approval_level_2 != NEW.approval_level_2 THEN
                    -- Hapus data approval lama
                    DELETE FROM approvals
                    WHERE booking_id = OLD.id_booking
                      AND approver_id = OLD.approval_level_2;

                    -- Tambahkan data approval baru
                    IF NEW.approval_level_2 IS NOT NULL THEN
                        INSERT INTO approvals (booking_id, approver_id, status, comments, created_at, updated_at)
                        VALUES (NEW.id_booking, NEW.approval_level_2, "pending", NULL, NOW(), NOW());
                    END IF;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_update_approval');
    }
}

