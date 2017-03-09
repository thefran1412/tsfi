<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->increments('id',255);
            $table->string('titol',255);
            $table->string('subTitol');
            $table->mediumText('descBreu');
            $table->longText('descDetaill1');
            $table->longText('descDetaill2');
            $table->integer('relevancia');
            $table->date('dataInici');
            $table->date('DdtaFinal');
            $table->boolean('Gratuit');
            $table->double('preuInferior', 15, 2);
            $table->double('preuSuperior', 15, 2);
            $table->dateTime('dataPublicacio');
            $table->boolean('visible');
            $table->string('fotoResum');
            $table->string('creatPer');
            $table->integer('idLocalitzacio')->references('id')->on('localitzacions');
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
        Schema::dropIfExists('recursos');
    }
}
