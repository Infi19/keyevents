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
        // Only run if the events table exists
        if (Schema::hasTable('events')) {
            Schema::table('events', function (Blueprint $table) {
                // Add status column if it doesn't exist
                if (!Schema::hasColumn('events', 'status')) {
                    $table->string('status')->default('pending')->after('time_to_period');
                }
                
                // Add user_id column if it doesn't exist
                if (!Schema::hasColumn('events', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('status');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                }
                
                // Add rejection_reason column if it doesn't exist
                if (!Schema::hasColumn('events', 'rejection_reason')) {
                    $table->text('rejection_reason')->nullable()->after('user_id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('events')) {
            Schema::table('events', function (Blueprint $table) {
                if (Schema::hasColumn('events', 'status')) {
                    $table->dropColumn('status');
                }
                
                if (Schema::hasColumn('events', 'user_id')) {
                    if (Schema::hasColumn('events', 'user_id')) {
                        $table->dropForeign(['user_id']);
                    }
                    $table->dropColumn('user_id');
                }
                
                if (Schema::hasColumn('events', 'rejection_reason')) {
                    $table->dropColumn('rejection_reason');
                }
            });
        }
    }
};
