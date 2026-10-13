<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('organization_card_purchases', function (Blueprint $table) {
            DB::statement("
        ALTER TABLE organization_card_purchases
        MODIFY payment_status
        ENUM('pending','paid','failed','free')
        DEFAULT 'pending'
    ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organization_card_purchases', function (Blueprint $table) {
            DB::statement("
        ALTER TABLE organization_card_purchases
        MODIFY payment_status
        ENUM('pending','paid','failed')
        DEFAULT 'pending'
    ");
        });
    }
};
