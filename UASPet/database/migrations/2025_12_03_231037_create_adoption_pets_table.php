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
        Schema::create('adoption_pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species');
            $table->string('breed')->nullable();
            $table->decimal('age', 5, 2)->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->decimal('weight', 5, 2)->nullable();
            $table->string('color')->nullable();
            $table->text('description');
            $table->boolean('vaccinated')->default(false);
            $table->boolean('sterilized')->default(false);
            $table->boolean('dewormed')->default(false);
            $table->decimal('adoption_fee', 10, 2)->default(0);
            $table->enum('status', ['available', 'reserved', 'adopted']);
            $table->json('images')->nullable(); // multiple images
            $table->text('special_notes')->nullable();
            $table->date('entry_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_pets');
    }
};
