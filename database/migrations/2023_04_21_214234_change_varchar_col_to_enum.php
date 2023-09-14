<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Traits\EnumMigrate;

return new class extends Migration {
    use EnumMigrate;

    private $table = "users";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $values = \App\Enums\Bonus3LevelsGroupsEnum::getValues();
        $this->changeEnumCol($this->table, 'bonus3_nivelhierarquico', $values, null);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $cols = ['bonus3_nivelhierarquico'];
        foreach ($cols as $col) {
            Schema::table($this->table, function (Blueprint $table) use ($col) {
                $table->string($col)->nullable()->change();
            });
        }

    }

};
