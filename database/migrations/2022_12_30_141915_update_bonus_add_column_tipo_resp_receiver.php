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
        //

        Schema::table('bonus', function (Blueprint $table) {

            //$table->enum('tipo', ['padrao', 'nao-padrao'])->default('nao-padrao');
            $table->string('group_tipo')->nullable(); // '1', '2', '3'
            $table->bigInteger('users_id_gerador_do_bonus')->unsigned()->nullable(); //id do user que gerou o bonus


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
