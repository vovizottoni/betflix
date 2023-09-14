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
        Schema::create('bets', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('games_id')->unsigned()->nullable();
            $table->foreign('games_id')->references('id')->on('games');

            $table->bigInteger('accounts_id')->unsigned()->nullable();
            $table->foreign('accounts_id')->references('id')->on('accounts');


            $table->timestamps();
            $table->softDeletes();
            $table->decimal('amount', 11, 2)->defualt(0.0);
            $table->decimal('odd', 11, 2)->defualt(1.1);
            $table->string('result'); // ['pending','green','red', 'canceled']

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
    }
};
