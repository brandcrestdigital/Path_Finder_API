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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('ticket_no')->unique();

            $table->enum('department', [
                'Support',
                'Migrations',
                
            ])->default('Support');

            $table->enum('urgency', [
                'Low',
                'Medium',
                'High',
                'Critical',
            ])->default('Medium');

            $table->string('control_panel_url')->nullable();
            $table->string('control_panel_username')->nullable();
            $table->text('control_panel_password')->nullable();

            $table->string('subject');

            $table->longText('message');

            $table->enum('status', [
                'open',
                'in_progress',
                'resolved',
                'closed',
            ])->default('open');

               $table->timestamp('closed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};