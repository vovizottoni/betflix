<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyc_validations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->unique()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('kyc_first_name')->nullable();
            $table->string('kyc_last_name')->nullable();
            $table->string('kyc_phone_number')->nullable();
            $table->date('kyc_date_birth')->nullable();
            $table->string('kyc_address_1')->nullable();
            $table->string('kyc_address_2')->nullable();
            $table->string('kyc_city')->nullable();
            $table->string('kyc_state')->nullable();
            $table->string('kyc_nationality')->nullable();
            $table->string('kyc_zip')->nullable();
            $table->enum('kyc_status', ['not_verified', 'under_verification', 'verified', 'failed_verification'])->default('not_verified');
            $table->string('kyc_nif')->nullable();
            $table->string('kyc_passport_path')->nullable();
            $table->string('kyc_identification_path_one')->nullable();
            $table->string('kyc_identification_path_two')->nullable();
            $table->string('kyc_drive_path')->nullable();
            $table->string('kyc_selfie_doc_path')->nullable();
            $table->string('kyc_reason')->nullable();
            $table->date('kyc_date_submitted')->nullable();
            $table->date('kyc_date_analysed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kyc_documents');
    }
};
