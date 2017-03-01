<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImatgeRecursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imatge_recurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titol', 200);
            $table->string('descImatge');
            $table->string('imatge');
            $table->string('ordre');
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
        Schema::dropIfExists('imatge_recurs');
    }
}
