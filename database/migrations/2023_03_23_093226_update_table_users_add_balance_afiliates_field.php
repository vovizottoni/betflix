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
        Schema::table('users', function (Blueprint $table) {
            $table->float('balanceAffiliates')
                ->default(0)
                ->nullable()
                ->message('Balanço total dos afiliados cadastrados via link de afiliado.');
            $table->string('contrato_social_url')
                ->nullable()
                ->message('Url do contrato social do usuário.');
        });

        DB::table('users')->update(['balanceAffiliates' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('balanceAffiliates');
            $table->dropColumn('contrato_social_url');
        });
    }
};
