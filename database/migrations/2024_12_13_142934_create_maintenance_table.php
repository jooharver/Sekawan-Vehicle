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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id('id_maintenance')->unsigned();
            $table->foreignId('vehicle_id')->constrained('vehicles', 'id_vehicle')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->dateTime('scheduled_date');
            $table->dateTime('completion_date')->nullable();
            $table->float('cost')->nullable();
            $table->enum('status', ['pending', 'maintenance', 'completed',]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
