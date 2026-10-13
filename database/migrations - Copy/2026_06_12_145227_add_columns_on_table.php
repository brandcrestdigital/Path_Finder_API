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
            $table->string('coupon_code')->after('payment_type')->nullable();
            $table->string('coupon_type')->after('coupon_code')->nullable();
            $table->string('coupon_value')->after('coupon_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organization_card_purchases', function (Blueprint $table) {

        });
    }
};
