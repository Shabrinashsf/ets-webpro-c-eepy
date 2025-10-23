<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('userid')->constrained('users')->onDelete('cascade');
            $table->foreignId('roomid')->constrained('rooms')->onDelete('cascade');
            $table->integer('price');
            $table->string('checkin');
            $table->string('checkout');
            $table->string("method");
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
