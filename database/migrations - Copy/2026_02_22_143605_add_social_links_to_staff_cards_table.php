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
            $table->string('linkedin')->nullable()->after('company_email');
            $table->string('instagram')->nullable()->after('linkedin');
            $table->string('facebook')->nullable()->after('instagram');
            $table->string('youtube')->nullable()->after('facebook');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_cards', function (Blueprint $table) {
            $table->string('linkedin')->nullable()->after('company_email');
            $table->string('instagram')->nullable()->after('linkedin');
            $table->string('facebook')->nullable()->after('instagram');
            $table->string('youtube')->nullable()->after('facebook');
        });
    }
};
