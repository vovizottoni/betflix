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
        Schema::table('group', function (Blueprint $table) {

            // -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --
            //1) Bônus 01:
            $table->bigInteger('bonus1_piso_integer')->nullable(); //PISO

            // -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --
            //2) Bônus 02:
            $table->bigInteger('bonus2_piso_integer')->nullable(); //PISO
            $table->bigInteger('bonus2_teto_integer')->nullable(); //TETO

            // -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --
            //3) Bônus 03:
            $table->bigInteger('bonus3_piso_integer')->nullable(); //PISO
            $table->bigInteger('bonus3_teto_integer')->nullable(); //TETO


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
