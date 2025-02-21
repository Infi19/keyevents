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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('about');
            $table->string('image_path')->nullable();
            $table->string('type');
            $table->string('category');
            $table->date('event_date');
            $table->integer('time_from_hour'); // Store hour
            $table->integer('time_from_minute'); // Store minute
            $table->string('time_from_period'); // Store AM/PM
            $table->integer('time_to_hour'); // Store hour
            $table->integer('time_to_minute'); // Store minute
            $table->string('time_to_period'); // Store AM/PM
             // To store the image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
