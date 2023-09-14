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
        Schema::create('tokens_accounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('accounts_id')->unsigned();
            $table->foreign('accounts_id')->references('id')->on('accounts');


            $table->text('tokenu');
            $table->string('game_code')->nullable(); //game_code associado ao games.game_code

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tokens_accounts');
    }
};
