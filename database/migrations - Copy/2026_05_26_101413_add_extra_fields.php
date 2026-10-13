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
        Schema::table('staff_cards', function (Blueprint $table) {
            $table->string('company_phone')->nullable();
            $table->string('bio')->nullable();
            $table->string('alternate_phone')->nullable();
            $table->string('whatsapp_number')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_cards', function (Blueprint $table) {
            $table->dropColumn(['company_phone', 'bio', 'alternate_phone', 'whatsapp_number', 'address']);
        });
    }
};
