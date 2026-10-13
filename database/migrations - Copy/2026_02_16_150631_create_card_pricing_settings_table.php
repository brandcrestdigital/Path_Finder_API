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
        Schema::create('card_pricing_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('price_per_card', 10, 2);
            $table->unsignedInteger('minimum_cards')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_pricing_settings');
    }
};
