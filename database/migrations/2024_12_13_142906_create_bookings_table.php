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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking')->unsigned();
            $table->foreignId('requester_id')->nullable()->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles', 'id_vehicle')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('drivers', 'id_driver')->onDelete('cascade');
            $table->string('start_point');
            $table->string('end_point');
            $table->float('distance_km');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->foreignId('approval_level_1')->nullable()->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('approval_level_2')->nullable()->constrained('users', 'id')->onDelete('cascade');
            $table->enum('approval_status_1', ['pending', 'approved', 'rejected']);
            $table->enum('approval_status_2', ['pending', 'approved', 'rejected']);
            $table->enum('status', ['pending', 'assigned', 'completed'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
