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
              $table->boolean('is_free_card')->default(false)->after('total_cards');

    $table->decimal('subtotal', 10, 2)->default(0)->after('is_free_card');
    $table->decimal('discount_amount', 10, 2)->default(0)->after('subtotal');
    $table->decimal('taxable_amount', 10, 2)->default(0)->after('discount_amount');

    $table->decimal('gst_percentage', 5, 2)->default(18)->after('taxable_amount');
    $table->decimal('gst_amount', 10, 2)->default(0)->after('gst_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organization_card_purchases', function (Blueprint $table) {
            //
        });
    }
};