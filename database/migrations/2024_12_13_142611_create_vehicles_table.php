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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('id_vehicle')->unsigned();
            $table->string('name');
            $table->string('plate_number')->unique();
            $table->enum('type', ['Angkutan Barang', 'Angkutan Orang']);
            $table->float('fuel_consumption');
            $table->enum('status', ['available', 'used', 'maintenance']);
            $table->enum('ownership', ['Owned', 'Rented']);
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
