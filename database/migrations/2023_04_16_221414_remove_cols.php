<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private array $cols = ['kyc_first_name', 'kyc_last_name', 'kyc_phone_number', 'kyc_date_birth', 'kyc_address_1',
        'kyc_address_2', 'kyc_city', 'kyc_state', 'kyc_nationality', 'kyc_zip', 'kyc_nif', 'kyc_passport_path',
        'kyc_identification_path_one', 'kyc_identification_path_two', 'kyc_drive_path', 'kyc_selfie_doc_path',
        'kyc_reason', 'kyc_date_submitted', 'kyc_date_analysed',];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cols = $this->cols;
        Schema::table('users', function (Blueprint $table) use ($cols) {
            foreach ($cols as $col) {
                $table->dropColumn($col);
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $cols = $this->cols;
        Schema::table('users', function (Blueprint $table) use ($cols) {
            foreach ($cols as $col) {
                $table->string($col)->nullable();
            }

        });
    }
};
