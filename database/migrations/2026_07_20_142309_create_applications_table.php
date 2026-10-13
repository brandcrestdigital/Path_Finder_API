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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            // Foreign Key to Webinar
            // Relation with Webinar
            $table->foreignId('webinar_id')->constrained()->onDelete('cascade');

            // Applicant Basic Info
            $table->string('full_name');
            $table->integer('age');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('country');
            $table->string('city');

            // Registering As
            $table->enum('registering_as', ['student', 'professional']);

            // Education (for Student)
            $table->string('current_class')->nullable();
            $table->string('school_college')->nullable();

            // Professional Details
            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->string('industry')->nullable();
            $table->string('linkedin_profile')->nullable();

            // Career & Reason
            $table->text('career_aspiration');
            $table->text('reason_for_joining');

            // Session Slot
            $table->dateTime('session_date_time')->nullable();

            // Parents Details
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_email')->nullable();

            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_email')->nullable();

            // Status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->foreignId('added_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
