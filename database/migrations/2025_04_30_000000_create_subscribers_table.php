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
        if (Schema::hasTable('subscribers')) {
            // Modify existing table
            Schema::table('subscribers', function (Blueprint $table) {
                // Drop the email column if it exists
                if (Schema::hasColumn('subscribers', 'email')) {
                    $table->dropColumn('email');
                }
                
                // Add the required columns if they don't exist
                if (!Schema::hasColumn('subscribers', 'user_id')) {
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                }
                
                if (!Schema::hasColumn('subscribers', 'event_id')) {
                    $table->foreignId('event_id')->constrained()->onDelete('cascade');
                }
                
                if (!Schema::hasColumn('subscribers', 'status')) {
                    $table->string('status')->default('registered');
                }
                
                if (!Schema::hasColumn('subscribers', 'attendance')) {
                    $table->boolean('attendance')->default(false);
                }
            });
        } else {
            // Create the table if it doesn't exist
            Schema::create('subscribers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('event_id')->constrained()->onDelete('cascade');
                $table->string('status')->default('registered');
                $table->boolean('attendance')->default(false);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't drop the table, just undo our changes
        if (Schema::hasTable('subscribers')) {
            Schema::table('subscribers', function (Blueprint $table) {
                // Only drop columns that we added
                if (Schema::hasColumn('subscribers', 'user_id')) {
                    $table->dropColumn('user_id');
                }
                
                if (Schema::hasColumn('subscribers', 'event_id')) {
                    $table->dropColumn('event_id');
                }
                
                if (Schema::hasColumn('subscribers', 'status')) {
                    $table->dropColumn('status');
                }
                
                if (Schema::hasColumn('subscribers', 'attendance')) {
                    $table->dropColumn('attendance');
                }
            });
        }
    }
}; 