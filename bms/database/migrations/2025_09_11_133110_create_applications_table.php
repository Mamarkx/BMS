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
        Schema::create('general_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('reference_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->date('dob');
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Divorced']);
            $table->string('year_of_residency');
            $table->string('email');
            $table->string('place_of_birth');
            $table->integer('age');
            $table->string('address');
            $table->integer('amount');
            $table->string('type');
            $table->string('purpose');
            $table->date('issue_date');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'To be Released'])->default('Pending');
            $table->string('id_proof')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('approved_by')->nullable();

            $table->date('release_date')->nullable();
            $table->string('released_by')->nullable();

            $table->timestamps();
        });
        Schema::create('id_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('reference_number');
            $table->string('name');
            $table->string('address');
            $table->date('dob');
            $table->integer('age');
            $table->string('place_of_birth');
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Divorced']);
            $table->string('year_of_residency');
            $table->string('email');
            $table->string('type');
            $table->string('purpose');
            $table->date('issue_date');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'To be Released'])->default('Pending');
            $table->string('religion');
            $table->string('height');
            $table->string('weight');
            $table->integer('amount');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('citezenship');
            $table->string('id_proof')->nullable();
            $table->string('precint_number');
            $table->string('emergency_name');
            $table->string('cellphone_number');
            $table->string('emergency_address');
            $table->date('approval_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('release_date')->nullable();
            $table->string('released_by')->nullable();
            $table->timestamps();
        });
        Schema::create('cedula_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('reference_number');
            $table->string('name');
            $table->string('tin');
            $table->string('address');
            $table->string('citezenship');
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Divorced']);
            $table->date('dob');
            $table->string('place_of_birth');
            $table->string('height');
            $table->string('weight');
            $table->string('total_gross_receipt_fr_business');
            $table->string('total_earning_fr_salaries');
            $table->string('total_income_fr_realproperty');
            $table->string('e-signature')->nullable();
            $table->string('email');
            $table->string('type');
            $table->integer('amount');
            $table->string('purpose');
            $table->date('issue_date');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'To be Released'])->default('Pending');
            $table->string('id_proof')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('release_date')->nullable();
            $table->string('released_by')->nullable();
            $table->timestamps();
        });
        Schema::create('business_permit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('reference_number');
            $table->string('name_owner');
            $table->string('name_business');
            $table->string('address_business');
            $table->string('email');
            $table->string('type');
            $table->integer('amount');
            $table->string('purpose');
            $table->date('issue_date');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'To be Released'])->default('Pending');
            $table->string('id_proof')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('release_date')->nullable();
            $table->string('released_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_form');
        Schema::dropIfExists('id_form');
        Schema::dropIfExists('cedula_form');
        Schema::dropIfExists('business_permit');
    }
};
