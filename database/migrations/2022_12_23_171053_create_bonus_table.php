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
        //Tabela que armazena todos bonus gerados no site betflix
        //Tabela que armazena todos bonus gerados no site betflix

        Schema::create('bonus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();


            //account que recebeu este bonus
            $table->bigInteger('accounts_id')->unsigned()->nullable();
            $table->foreign('accounts_id')->references('id')->on('accounts');


            //group_id que gerou esse bonus
            $table->bigInteger('group_id')->unsigned()->nullable();

            //bet_id
            $table->bigInteger('bets_id')->unsigned()->nullable();

            //transaction_id
            $table->bigInteger('transactions_id')->unsigned()->nullable();

            //amount bonus
            $table->decimal('amount', 11, 2)->defualt(0.0);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus');
    }
};
