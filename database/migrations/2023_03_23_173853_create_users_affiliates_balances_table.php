<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('tipos_transacoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->boolean('status');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::insert('insert into tipos_transacoes (nome, status) values (?, ?)', ['recebimento_de_bonus', 1]);
        DB::insert('insert into tipos_transacoes (nome, status) values (?, ?)', ['retirada_de_bonus', 1]);

        Schema::create('transactions_affiliates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')
                ->message('Usuário que recebeu o afiliado.');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('tipos_transacoes_id')
                ->message('Id referente ao tipo de transação na tabela tipos_transacoes.');
            $table->foreign('tipos_transacoes_id')->references('id')->on('tipos_transacoes');

            $table->unsignedBigInteger('account_id')
                ->message('Id referente a conta bancária do usuário na tabela accounts.');
            $table->foreign('account_id')->references('id')->on('accounts');

            $table->unsignedBigInteger('bonus3_semanapagamento')
                ->message('Referência da semana de pagamento');
            $table->enum('status', ['pago', 'pendente', 'recusado'])
                ->default('pendente');
            $table->float('valor', 8, 2)
                ->message('Valor da transação');
            $table->string('url_nota_fiscal')->nullable()
                ->message('Url da nota fiscal');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_affiliates');
        Schema::dropIfExists('tipos_transacoes');
    }
};
