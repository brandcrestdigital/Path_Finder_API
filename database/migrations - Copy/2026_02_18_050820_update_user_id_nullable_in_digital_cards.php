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
        Schema::table('digital_cards', function (Blueprint $table) {
            Schema::table('digital_cards', function (Blueprint $table) {

                // Drop foreign key
                $table->dropForeign(['user_id']);

                // Make nullable
                $table->unsignedBigInteger('user_id')->nullable()->change();

                // Add foreign key with set null on delete
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->nullOnDelete();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('digital_cards', function (Blueprint $table) {
            //
        });
    }
};
