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
        Schema::table('users', function (Blueprint $table) {

            $table->enum('rollover_bonus1_opcao', ['s', 'n'])->default('n');
            $table->bigInteger('rollover_bonus1_multiplicador')->unsigned()->nullable();
            $table->decimal('rollover_bonus1_valorObjetivo', 11, 2)->nullable();
            $table->enum('rollover_bonus1_atingiu_valorObjetivo', ['s', 'n'])->default('n');

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
