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
                if (!Schema::hasColumn('subscribers', 'status')) {
                    $table->string('status')->default('registered')->after('event_id');
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
                if (Schema::hasColumn('subscribers', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }
    }
};
