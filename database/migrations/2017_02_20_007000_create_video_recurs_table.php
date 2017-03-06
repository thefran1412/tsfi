<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoRecursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_recurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idTipus')->references('id')->on('tipus_videos');
            $table->integer('idRecurs')->references('id')->on('recursos');
            $table->string('urlVideo');
            $table->string('titol');
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
        Schema::dropIfExists('video_recurs');
    }
}
