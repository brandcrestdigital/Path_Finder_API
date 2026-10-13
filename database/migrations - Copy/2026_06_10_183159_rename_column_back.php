<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. heading
     */
    public function up(): void
    {
        Schema::table('staff_services', function (Blueprint $table) {
            $table->renameColumn('heading', 'service_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_services', function (Blueprint $table) {
            //
        });
    }
};
