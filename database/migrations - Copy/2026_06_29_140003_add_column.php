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
              $table->float('nfc_price_per_card', 10, 2)->default(0)->after('price_per_card');
        $table->boolean('is_nfc_card')->default(false)->after('nfc_price_per_card');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organization_card_purchases', function (Blueprint $table) {
             $table->dropColumn([
            'nfc_price_per_card',
            'is_nfc_card',
        ]);
        });
    }
};
