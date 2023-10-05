<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('make_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('vin')->nullable();
            $table->string('title_status')->nullable();
            $table->string('location')->nullable();
            $table->string('drivetrain')->nullable();
            $table->string('engine')->nullable();
            $table->string('transmission')->nullable();
            $table->bigInteger('body_style_id');
            $table->string('exterior_color')->nullable();
            $table->string('interior_color')->nullable();
            $table->string('seller_id')->nullable();
            $table->string('seller_type')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
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
        Schema::drop('vehicles');
    }
}
