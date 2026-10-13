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
        Schema::create('whats_app_unsubscribes', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique()->index();
            $table->boolean('is_active')->default(true);
            $table->timestamp('unsubscribed_at')->useCurrent();
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whats_app_unsubscribes');
    }
};
