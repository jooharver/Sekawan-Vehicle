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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id('id_approval')->unsigned();
            $table->foreignId('booking_id')->constrained('bookings', 'id_booking')->onDelete('cascade');
            $table->foreignId('approver_id')->constrained('users', 'id')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
