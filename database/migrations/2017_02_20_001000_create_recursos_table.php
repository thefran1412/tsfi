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
            $table->increments('id');
            $table->string('TitolResum', 150);
            $table->string('SubTitolResum', 250);
            $table->string('DecBreu', 500);
            $table->string('DescDetaill1');
            $table->string('DescDetaill2');
            $table->integer('Relevancia');
            $table->date('DataInici');
            $table->date('DataFinal');
            $table->boolean('Gratuit');
            $table->double('PreuInferior', 15, 2);
            $table->double('PreuSuperior', 15, 2);
            $table->dateTime('DataPublicacio');
            $table->boolean('Visible');
            $table->string('FotoResum');
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
