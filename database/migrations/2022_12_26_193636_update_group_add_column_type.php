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
            //Por padrao todos usuarios que entrao no sistema iniciam-se com o grupo 'padrao'. Opcoes: 'padrao' e 'nao-padrao'

            $table->enum('tipo', ['padrao', 'nao-padrao'])->default('nao-padrao');

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
