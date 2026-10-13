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
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropForeign(['added_by']);

            // Make it nullable and remove strict foreign key (or keep it pointing to users only)
            $table->unsignedBigInteger('added_by')->nullable()->change();

            // Optional: If you want to support both users and employees later
            $table->string('added_by_type')->nullable()->after('added_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->foreignId('added_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->change();
        });
    }
};
