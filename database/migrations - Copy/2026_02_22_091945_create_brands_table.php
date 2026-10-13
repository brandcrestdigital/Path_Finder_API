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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->unique();

            $table->string('brand_name');
            $table->string('logo')->nullable();
            $table->string('cover_page')->nullable();

            $table->boolean('template_change')->default(true);
            $table->boolean('cover_change')->default(true);
            $table->boolean('custom_community_logo')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
