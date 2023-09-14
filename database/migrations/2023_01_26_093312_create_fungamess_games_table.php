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
        Schema::create('fungamess_games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('fungamess_provider_id')->unsigned()->nullable();

            $table->bigInteger('provider_id')->unsigned()->nullable();
            $table->foreign('provider_id')->references('id')->on('fungamess_providers');

            $table->integer('game_id')->index();
            $table->string('name');
            $table->decimal('basicRTP', 12, 2)->default(0);

            $table->string('type');
            $table->string('img')->nullable();
            $table->boolean('demo')->default(false);
            $table->string('device');
            $table->string('game_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fungamess_games');
    }
};
