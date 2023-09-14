<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

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
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
