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
        Schema::table('meetings', function (Blueprint $table) {
            $table->string('cancelled_by')
                ->nullable()
                ->after('status');

            $table->text('cancelled_remarks')
                ->nullable()
                ->after('cancelled_by');

            $table->timestamp('cancelled_at')
                ->nullable()
                ->after('cancelled_remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            //
        });
    }
};
