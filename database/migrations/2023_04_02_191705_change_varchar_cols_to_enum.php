<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Traits\EnumMigrate;

return new class extends Migration {
    use EnumMigrate;

    private $table = "transactions";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            $values = \App\Enums\TransactionType::getValues();
            $this->changeEnumCol($this->table, 'type', $values);
            $values = \App\Enums\TransactionStatus::getValues();
            $this->changeEnumCol($this->table, 'status', $values);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $cols = ['type', 'status'];
        foreach ($cols as $col) {
            Schema::table($this->table, function (Blueprint $table) use ($col) {
                $table->string($col)->change();
            });
        }

    }

};
