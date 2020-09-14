<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //软件名称
            $table->string('description')->nullable();  //软件描述
            $table->integer('category_id'); //软件分类
            $table->string('version');  //版本
            $table->integer('vendor_id');   //供应商
            $table->double('price');    //价格
            $table->integer('purchased');   //购买日
            $table->integer('expired'); //有效期
            $table->

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
        Schema::dropIfExists('software');
    }
}
