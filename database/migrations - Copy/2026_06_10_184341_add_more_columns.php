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
            $table->string('pincode')->nullable()->after('whatsapp_number');
            $table->string('country')->nullable()->after('pincode');
            $table->string('phone_code')->nullable()->after('country');
            $table->string('state')->nullable()->after('phone_code');
            $table->string('city')->nullable()->after('state');
            $table->text('address')->nullable()->after('city');
            $table->longText('additional_phones')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_cards', function (Blueprint $table) {
            //
        });
    }
};
