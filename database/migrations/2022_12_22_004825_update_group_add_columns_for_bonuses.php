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
            //1) Bônus 01: [Usuario] Primeiro depósito:
            //O usuário ao depositar irá ganhar X% do VALOR do próprio primeiro depósito, em Saldo Bônus. Se o VALOR > TETO, o bonus continuará sendo aplicado no          TETO
            $table->enum('bonus1_status', ['active', 'inactive'])->default('inactive');
            $table->bigInteger('bonus1_percentual_valor_integer')->nullable(); // 1, 2, 3 - 100, percentual representado como inteiro. Ex 20 => 20%
            $table->bigInteger('bonus1_teto_integer')->nullable(); //TETO
            $table->enum('bonus1_destino', ['balanceNormal', 'balanceBonus'])->default('balanceNormal'); //pode-se escolher o destino do bonus(ex: se for um deposito em BRL, pode escolher entre balance ou balanceBonus)
            //Obs: A account que receberá o bonus é a account armazenada na sessao.

            // -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --
            //2) Bônus 02: [Afiliado] Bônus sobre primeiro depósito:
            //O afiliado irá ganhar x% do valor do primeiro depósito dos indicados dele;
            $table->enum('bonus2_status', ['active', 'inactive'])->default('inactive');
            $table->bigInteger('bonus2_percentual_valor_integer')->nullable(); // 1, 2, 3 - 100, percentual representado como inteiro. Ex 20 => 20%
            $table->enum('bonus2_destino', ['balanceNormal', 'balanceBonus'])->default('balanceNormal'); //pode-se escolher o destino do bonus (ex: se for um deposito em BRL, pode escolher entre balance ou balanceBonus)
            //Obs: A account do afiliado que receberá o bonus é a primeira account (menor id) desse afiliado.


            // -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --  -- -- -- -- --
            //3) Bônus 03: [Afiliado] Bônus sobre perda:
            //O afiliado irá ganhar x% das apostas perdidas dos indicados dele;
            $table->enum('bonus3_status', ['active', 'inactive'])->default('inactive');
            $table->bigInteger('bonus3_percentual_valor_integer')->nullable(); // 1, 2, 3 - 100, percentual representado como inteiro. Ex 20 => 20%
            //Escolher qual tipo de aposta se aplica esse bonus3: apostas usando 'balanceNormal', 'balanceBonus' ou ambas
            $table->enum('bonus3_tipo_aposta_balance', ['balanceNormal', 'balanceBonus', 'ambos'])->default('balanceNormal');
            //pode-se escolher o destino do bonus (ex: se for uma aposta em BRL, pode escolher entre balance ou balanceBonus)
            $table->enum('bonus3_destino', ['balanceNormal', 'balanceBonus'])->default('balanceNormal');
            //Obs: A account do afiliado que receberá o bonus é a primeira account (menor id) desse afiliado.




            /*

                -- -- -- REGRAS PARA CADA TIPO DE BONUS  -- -- --
                1) Bônus 01: [Usuario] Primeiro depósito:
                O usuário ao depositar irá ganhar X% do valor do próprio primeiro depósito, em Saldo Bônus. Se o valor > TETO, o bonus continuará sendo aplicado no TETO


                2) Bônus 02: [Afiliado] Bônus sobre primeiro depósito:
                O afiliado irá ganhar x% do valor do primeiro depósito dos indicados dele;


                3) Bônus 03: [Afiliado] Bônus sobre perda:
                O afiliado irá ganhar x% das apostas perdidas dos indicados dele;

                -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

            */





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
