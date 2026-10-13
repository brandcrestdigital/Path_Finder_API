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
        Schema::create('organization_card_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('card_package_id')->nullable()->constrained()->nullOnDelete();

            $table->integer('total_cards');
            $table->integer('used_cards')->default(0);
            $table->decimal('price_per_card', 10, 2);
            $table->decimal('total_amount', 10, 2);

            $table->integer('validity_days');
            $table->date('start_date');
            $table->date('expiry_date');

            $table->enum('payment_status', ['paid', 'pending'])->default('paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_card_purchases');
    }
};