<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    use \Database\Traits\EnumMigrate;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->changeEnumCol("bets", "result", \App\Enums\HypetechResults::getValues());

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
