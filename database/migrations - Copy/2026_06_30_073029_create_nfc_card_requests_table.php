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
        Schema::create('nfc_card_requests', function (Blueprint $table) {
            $table->id();
            
             $table->foreignId('organization_id')->constrained()->cascadeOnDelete();

    $table->foreignId('purchase_id')
        ->constrained('organization_card_purchases')
        ->cascadeOnDelete();

    $table->string('card_link')->nullable();

    $table->string('address_line1');
    $table->string('address_line2')->nullable();
    $table->string('landmark')->nullable();

    $table->string('pincode', 10);
    $table->string('city');
    $table->string('district')->nullable();
    $table->string('state');
    $table->string('country')->default('India');

    $table->text('remarks')->nullable();

    $table->enum('status', [
        'pending',
        'approved',
        'rejected',
        'completed'
    ])->default('pending');

    $table->text('rejected_reason')->nullable();

    $table->foreignId('approved_by')->nullable()->constrained('users');

    $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfc_card_requests');
    }
};
