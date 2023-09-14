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

        Schema::table('accounts', function (Blueprint $table) {

            $table->decimal('balanceUSD', 12, 2)->default(0);        //corrigido default - ok
            $table->decimal('balanceUSDBonus', 12, 2)->default(0);   //corrigido default - ok

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
