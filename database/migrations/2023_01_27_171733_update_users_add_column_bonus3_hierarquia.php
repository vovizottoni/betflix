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

        Schema::table('users', function (Blueprint $table) {

            $table->bigInteger('bonus3_superiorhierarquico_user_id')->unsigned()->nullable(); // ID do usuário que é super hierarquico do usuário corrente (quem está um nível acima desse usuário corrente)
            $table->enum('bonus3_nivelhierarquico', \App\Enums\Bonus3LevelsGroupsEnum::getValues())->nullable(); // 'master', 'supervisor', 'gerente', 'subgerente'
            $table->decimal('bonus3_percentual', 11, 2)->nullable(); // ex: 20.35%


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
