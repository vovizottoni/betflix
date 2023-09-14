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


            $table->string('my_invite_code')->nullable(); //Se user tem esse campo preenchido, ele é um influenciador

            $table->bigInteger('user_id')->unsigned()->nullable(); //se user tem esse campo preenchido, ele é um convidado (utilizou o código de um influenciador)
            $table->string('invite_code')->nullable(); //código de convite utilizado


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
