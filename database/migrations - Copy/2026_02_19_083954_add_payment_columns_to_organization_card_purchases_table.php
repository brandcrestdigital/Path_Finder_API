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
        Schema::table('organization_card_purchases', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->string('payment_type')->nullable()->after('payment_proof');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organization_card_purchases', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_proof',
                'payment_type',
            ]);
        });
    }
};
