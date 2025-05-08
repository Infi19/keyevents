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
        // Only create the table if it doesn't exist
        if (!Schema::hasTable('events')) {
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
                $table->string('brochure_path')->nullable();
                $table->timestamps();
            });
        } else {
            // If the table exists, check if it has the required columns
            Schema::table('events', function (Blueprint $table) {
                if (!Schema::hasColumn('events', 'title')) {
                    $table->string('title');
                }
                if (!Schema::hasColumn('events', 'about')) {
                    $table->text('about');
                }
                if (!Schema::hasColumn('events', 'image_path')) {
                    $table->string('image_path')->nullable();
                }
                if (!Schema::hasColumn('events', 'type')) {
                    $table->string('type');
                }
                if (!Schema::hasColumn('events', 'category')) {
                    $table->string('category');
                }
                if (!Schema::hasColumn('events', 'event_date')) {
                    $table->date('event_date');
                }
                if (!Schema::hasColumn('events', 'time_from_hour')) {
                    $table->integer('time_from_hour');
                }
                if (!Schema::hasColumn('events', 'time_from_minute')) {
                    $table->integer('time_from_minute');
                }
                if (!Schema::hasColumn('events', 'time_from_period')) {
                    $table->string('time_from_period');
                }
                if (!Schema::hasColumn('events', 'time_to_hour')) {
                    $table->integer('time_to_hour');
                }
                if (!Schema::hasColumn('events', 'time_to_minute')) {
                    $table->integer('time_to_minute');
                }
                if (!Schema::hasColumn('events', 'time_to_period')) {
                    $table->string('time_to_period');
                }
                if (!Schema::hasColumn('events', 'brochure_path')) {
                    $table->string('brochure_path')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't drop the table if we just modified it
        if (Schema::hasTable('events') && !Schema::hasColumn('events', 'status')) {
            Schema::dropIfExists('events');
        }
    }
};
