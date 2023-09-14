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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();


            $table->bigInteger('accounts_id')->unsigned()->nullable();
            $table->foreign('accounts_id')->references('id')->on('accounts');
            $table->enum('type', \App\Enums\TransactionType::getValues());
            $table->enum('status', \App\Enums\TransactionStatus::getValues());
            $table->decimal('amount', 12, 2);
            $table->string('external_reference');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
