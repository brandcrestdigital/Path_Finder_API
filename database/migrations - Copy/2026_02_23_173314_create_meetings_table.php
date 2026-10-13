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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();

            // 👤 Staff who receives meeting
            $table->unsignedBigInteger('user_id');

            // 👥 Person who is requesting
            $table->string('requester_name');

            $table->string('title');
            $table->text('description')->nullable();

            $table->date('meeting_date');
            $table->time('meeting_time');

            $table->string('status')->default('pending');
            // pending | approved | rejected

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
