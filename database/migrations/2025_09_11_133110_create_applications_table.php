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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->date('dob');
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Divorced']);
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('type');
            $table->string('purpose');
            $table->date('issue_date');

            // Status of the request (Pending, Approved, Rejected)
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');

            // Fields for storing file paths for ID proof and address proof (optional)
            $table->string('id_proof')->nullable(); // Store single file path for ID proof
            $table->string('address_proof')->nullable(); // Store single file path for address proof

            // New fields for approval and release scheduling
            $table->date('approval_date')->nullable(); // The date when the application is approved
            $table->string('approved_by')->nullable(); // The person who approved the document (e.g., Barangay Chairman)

            $table->date('release_date')->nullable(); // The date when the document will be released
            $table->string('released_by')->nullable(); // The person who released the document

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
