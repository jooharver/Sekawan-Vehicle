<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AddBookingUpdateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Buat trigger untuk pembaruan di tabel bookings
        DB::unprepared("
            CREATE TRIGGER trigger_update_booking AFTER UPDATE ON bookings
            FOR EACH ROW
            BEGIN
                -- Logika 1: Update UsageLog jika status berubah menjadi 'assigned'
                IF NEW.status = 'assigned' AND OLD.status != 'assigned' THEN
                    IF NEW.vehicle_id IS NOT NULL AND NEW.driver_id IS NOT NULL THEN
                        INSERT INTO usage_logs (
                            booking_id, vehicle_id, start_date, end_date,
                            start_point, end_point, distance_km, fuel_used,
                            created_at, updated_at
                        )
                        SELECT
                            NEW.id_booking,
                            NEW.vehicle_id,
                            NEW.start_date,
                            NEW.end_date,
                            NEW.start_point,
                            NEW.end_point,
                            NEW.distance_km,
                            (NEW.distance_km / v.fuel_consumption),
                            NOW(),
                            NOW()
                        FROM vehicles v
                        WHERE v.id_vehicle = NEW.vehicle_id;
                    END IF;
                END IF;

                -- Logika 3: Perubahan status driver
                IF NEW.driver_id != OLD.driver_id THEN
                    IF OLD.driver_id IS NOT NULL THEN
                        UPDATE drivers SET status = 'available' WHERE id_driver = OLD.driver_id;
                    END IF;

                    IF NEW.driver_id IS NOT NULL THEN
                        UPDATE drivers SET status = 'assigned' WHERE id_driver = NEW.driver_id;
                    END IF;
                END IF;

                -- Logika 4: Perubahan status kendaraan
                IF NEW.vehicle_id != OLD.vehicle_id THEN
                    IF OLD.vehicle_id IS NOT NULL THEN
                        UPDATE vehicles SET status = 'available' WHERE id_vehicle = OLD.vehicle_id;
                    END IF;

                    IF NEW.vehicle_id IS NOT NULL THEN
                        UPDATE vehicles SET status = 'used' WHERE id_vehicle = NEW.vehicle_id;
                    END IF;
                END IF;

                -- Logika 5: Jika status diubah menjadi 'completed', set status kendaraan dan driver ke 'available'
                IF NEW.status = 'completed' AND OLD.status != 'completed' THEN
                    IF NEW.vehicle_id IS NOT NULL THEN
                        UPDATE vehicles SET status = 'available' WHERE id_vehicle = NEW.vehicle_id;
                    END IF;

                    IF NEW.driver_id IS NOT NULL THEN
                        UPDATE drivers SET status = 'available' WHERE id_driver = NEW.driver_id;
                    END IF;
                END IF;

            END;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus trigger jika migration dibatalkan
        DB::unprepared("DROP TRIGGER IF EXISTS trigger_update_booking");
    }
}
