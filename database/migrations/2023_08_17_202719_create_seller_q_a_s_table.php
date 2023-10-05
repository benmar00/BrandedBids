<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerQASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_q_a_s', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('type')->default('question');
            $table->bigInteger('question_id')->default(0);
            $table->bigInteger('vehicle_id');
            $table->text('content');
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
        Schema::dropIfExists('seller_q_a_s');
    }
}
