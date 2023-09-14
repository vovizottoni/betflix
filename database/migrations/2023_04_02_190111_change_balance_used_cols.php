<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Traits\EnumMigrate;

return new class extends Migration {

    private array $tables = ['bets', 'tokens_accounts', 'transactions'];
    use EnumMigrate;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            $col = "balance_used";
            $values = \App\Enums\BalanceUsedEnum::getValues();
            foreach ($this->tables as $tb) {
                if ($tb == 'bets') {
                    $this->changeEnumCol($tb, $col, $values);
                } else {
                    $this->changeEnumCol($tb, $col, $values, \App\Enums\BalanceUsedEnum::Balance);
                }
            }



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $col = "balance_used";
        foreach ($this->tables as $tb) {
            Schema::table($tb, function (Blueprint $table) use ($col, $tb) {
                if ($tb == 'bets') {
                    $table->string($col)->change();
                } else {
                    $table->string($col)->default(\App\Enums\BalanceUsedEnum::Balance)->change();

                }

            });
        }
    }
};
