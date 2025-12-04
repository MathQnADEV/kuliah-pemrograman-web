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
        Schema::create('pet_hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('owner_name')->nullable(false);
            $table->string('owner_phone')->nullable(false);
            $table->string('pet_name')->nullable(false);
            $table->string('pet_type')->nullable(false);
            $table->decimal('pet_weight', 5, 2)->nullable(false);
            $table->string('temprament')->nullable(false);
            $table->enum('room_type', ['standard', 'premium', 'luxury'])->nullable(false);
            $table->boolean('bring_own_food')->default(false);
            $table->date('check_in')->nullable(false);
            $table->date('check_out')->nullable(false);
            $table->integer('total_price')->nullable(false);
            $table->enum('payment_status', ['unpaid', 'paid', 'partial'])->default('unpaid');
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
            $table->text('user_notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_hotel_bookings');
    }
};
