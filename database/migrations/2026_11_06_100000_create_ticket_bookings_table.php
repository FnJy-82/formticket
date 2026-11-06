<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 16)->unique();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 30);
            $table->date('birthdate');
            $table->string('ticket_type', 30);
            $table->unsignedTinyInteger('quantity');
            $table->unsignedBigInteger('total_price');
            $table->string('confirmation_token', 64)->unique();
            $table->timestamp('confirmation_expires_at');
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_bookings');
    }
};
