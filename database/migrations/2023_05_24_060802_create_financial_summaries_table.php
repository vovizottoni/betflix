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
        Schema::create('financial_summaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer("link_visits")->default(0);
            $table->integer("unique_link_visits")->default(0);
            $table->integer("user_register")->default(0);
            $table->integer("deposits_qty")->default(0);
            $table->decimal('total_deposits', 12, 2);
            $table->integer("bets_qty")->default(0);
            $table->decimal('total_bets', 12, 2);
            $table->integer("link_visits");


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
        Schema::dropIfExists('financial_summaries');
    }
};
