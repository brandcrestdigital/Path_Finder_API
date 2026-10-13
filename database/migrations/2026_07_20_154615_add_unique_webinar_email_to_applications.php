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
        Schema::table('applications', function (Blueprint $table) {
            // Drop old single email unique if it exists
            if (Schema::hasColumn('applications', 'email')) {
                $indexes = \DB::select("SHOW INDEX FROM applications WHERE Column_name = 'email' AND Key_name != 'PRIMARY'");

                foreach ($indexes as $index) {
                    $table->dropIndex($index->Key_name);
                }
            }

            // Add composite unique (webinar_id + email)
            $table->unique(['webinar_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropUnique(['webinar_id', 'email']);
        });
    }
};