<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlaggedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flaggeds', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('comment_id')->nullable();
            $table->string('user_id')->nullable();
            $table->tinyInteger('status')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flaggeds');
    }
}
