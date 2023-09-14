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

            $table->enum('bonus3_processado',['s','n'])->default('n');
            $table->bigInteger('bonus3_semanapagamento')->unsigned()->default(1);
            $table->string('bonus3_sinal')->nullable();

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
