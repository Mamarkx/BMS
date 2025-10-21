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
        Schema::create('personnel', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Ensure InnoDB engine for foreign keys

            // Personnel Details
            $table->string('personnel_id')->primary(); // Unique Personnel ID (e.g., P-10001)
            $table->string('first_name', 100); // First name
            $table->string('middle_name', 100)->nullable(); // Middle name (optional)
            $table->string('last_name', 100); // Last name
            $table->enum('gender', ['Male', 'Female', 'Other']); // Gender
            $table->date('birthdate'); // Date of birth
            $table->string('contact_number', 15); // Contact number
            $table->string('email', 100); // Email address
            $table->text('address'); // Full address
            $table->string('position_title', 100); // Position title (e.g., Barangay Captain)
            $table->string('department', 100); // Department or office (e.g., Office of the Captain)
            $table->date('hire_date'); // Date of hire
            $table->enum('status', ['Active', 'Inactive', 'Resigned', 'Terminated'])->default('Active'); // Employment status

            // Emergency Contact Information
            $table->string('emergency_contact', 100)->nullable(); // Emergency contact name (optional)
            $table->string('emergency_number', 15)->nullable(); // Emergency contact number (optional)

            $table->timestamps(); // Timestamps (created_at and updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel');
    }
};
