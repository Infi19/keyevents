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
        // Check if the table already exists and if it has the 'email' field
        // If it does, we can assume this is the newsletter subscribers table, not event subscribers
        if (!Schema::hasTable('subscribers') || (Schema::hasTable('subscribers') && !Schema::hasColumn('subscribers', 'user_id'))) {
            // Rename old subscribers table to newsletter_subscribers if it exists with email column
            if (Schema::hasTable('subscribers') && Schema::hasColumn('subscribers', 'email')) {
                Schema::rename('subscribers', 'newsletter_subscribers');
            }
            
            // Create the event subscribers table
            Schema::create('subscribers', function (Blueprint $table) {
                $table->id();
                $table->string('email')->unique();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop if this table is the newsletter subscribers
        if (Schema::hasTable('subscribers') && Schema::hasColumn('subscribers', 'email') && !Schema::hasColumn('subscribers', 'user_id')) {
            Schema::dropIfExists('subscribers');
        }
        
        // Restore the original name if we renamed it
        if (Schema::hasTable('newsletter_subscribers')) {
            Schema::rename('newsletter_subscribers', 'subscribers');
        }
    }
};
