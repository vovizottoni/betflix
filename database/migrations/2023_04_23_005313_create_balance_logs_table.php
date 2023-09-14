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
        Schema::create('balance_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('accounts_id')->unsigned()->nullable();
            $table->foreign('accounts_id')->references('id')->on('accounts');
            $table->string('code', '50');
            $table->string('value', '50');
            $table->string('old_balance', '50');
            $table->string('new_balance', '50');
            $table->string('balance_col', '50');
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
        Schema::dropIfExists('balance_logs');
    }
};
