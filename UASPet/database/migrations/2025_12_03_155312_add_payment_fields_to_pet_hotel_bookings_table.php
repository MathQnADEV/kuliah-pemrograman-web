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
        Schema::table('pet_hotel_bookings', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->decimal('paid_amount', 12, 2)->default(0)->after('total_price');
            $table->dateTime('payment_date')->nullable()->after('paid_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pet_hotel_bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_proof', 'paid_amount', 'payment_date']);
        });
    }
};
