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
            $table->string('type'); // In-Person, Virtual
            $table->string('category'); // e.g., Workshop, Seminar, etc.
            $table->date('event_date');
            $table->integer('time_from_hour');
            $table->integer('time_from_minute');
            $table->string('time_from_period'); // AM, PM
            $table->integer('time_to_hour');
            $table->integer('time_to_minute');
            $table->string('time_to_period'); // AM, PM
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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