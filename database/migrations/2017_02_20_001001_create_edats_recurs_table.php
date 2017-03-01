<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEdatsRecursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edats_recurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idEdat')->references('id')->on('edats');
            $table->integer('idRecurs')->references('id')->on('recursos');
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
        Schema::dropIfExists('edats_recurs');
    }
}
