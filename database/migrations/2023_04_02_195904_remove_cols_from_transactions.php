<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private array $cols = ['coingate_id_transaction', 'coingate_payment_url', 'coingate_token'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cols = $this->cols;
        Schema::table('transactions', function (Blueprint $table) use ($cols) {
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
        Schema::table('transactions', function (Blueprint $table) use ($cols) {
            foreach ($cols as $col) {
                $table->string($col)->nullable();
            }

        });
    }
};
