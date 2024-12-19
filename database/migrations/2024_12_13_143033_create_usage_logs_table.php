<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('usage_logs', function (Blueprint $table) {
            $table->id('id_usagelog')->unsigned();
            $table->foreignId('vehicle_id')->constrained('vehicles', 'id_vehicle')->onDelete('cascade');
            $table->foreignId('booking_id')->constrained('bookings', 'id_booking')->onDelete('cascade');
            $table->string('start_point');
            $table->string('end_point');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('distance_km');
            $table->float('fuel_used');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usage_logs');
    }
};
