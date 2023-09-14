<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->foreign('users_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
