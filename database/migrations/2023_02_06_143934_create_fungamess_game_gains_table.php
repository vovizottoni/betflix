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
        Schema::create('fungamess_game_gains', function (Blueprint $table) {
            $table->id();

            $table->string('token')->unique();

            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users');

            $table->bigInteger('game_id')->unsigned()->nullable();
            $table->foreign('game_id')->references('id')->on('fungamess_games');

            $table->text('extra_data');
            $table->string('event_id');
            $table->string('direction'); // debit, credit: Indica Débito ou Crédito. Débito: da carteira do jogador. Crédito: à carteira do jogador.
            $table->string('transaction_id');
            $table->string('event_type'); // betSingle, betExpress, betSystem, cancel, cashOutSimple, Tip, BetPayedAbort, BetPlacingAbort.
            $table->string('time');
            $table->decimal('amount', 11, 2)->defualt(0.0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fungamess_game_gains');
    }
};
