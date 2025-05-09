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
            Schema::table('subscribers', function (Blueprint $table) {
                if (!Schema::hasColumn('subscribers', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('status');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('subscribers')) {
            Schema::table('subscribers', function (Blueprint $table) {
                if (Schema::hasColumn('subscribers', 'is_active')) {
                    $table->dropColumn('is_active');
                }
            });
        }
    }
};
