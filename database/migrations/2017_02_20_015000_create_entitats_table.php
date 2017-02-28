<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entitats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('adreca');
            $table->integer('telf1');
            $table->integer('telf2');
            $table->string('link');
            $table->string('logo');
            $table->string('desc');
            $table->integer('idLocalitzacio')->references('id')->on('localitzacio');
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
        Schema::dropIfExists('entitats');
    }
}
