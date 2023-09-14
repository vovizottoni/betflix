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
        Schema::create('command_bonus3_processamento', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->bigInteger('bonus3_semanapagamento')->unsigned()->default(1);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('command_bonus3_processamento');
    }
};
