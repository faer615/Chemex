<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDimensionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimensions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('color');
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('dimension_tracking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('dimension_id');
            $table->integer('level');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('dimensions');
        Schema::dropIfExists('dimension_tracking');
    }
}
