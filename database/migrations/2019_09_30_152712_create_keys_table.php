<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->string('key');
            $table->timestamp('expires')->nullable();
            $table->string('hwid')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('last_use')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('app_id')->references('id')->on('apps');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('keys');
    }
}
