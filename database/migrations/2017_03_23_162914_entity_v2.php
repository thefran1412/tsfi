<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntityV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE entitats ADD facebook varchar(250);');
        DB::statement('ALTER TABLE entitats ADD twitter varchar(250);');
        DB::statement('ALTER TABLE entitats ADD instagram varchar(250);');

        DB::statement('DROP TABLE social_medias;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE entitats DROP facebook varchar(250);');
        DB::statement('ALTER TABLE entitats DROP twitter varchar(250);');
        DB::statement('ALTER TABLE entitats DROP instagram varchar(250);');

        Schema::create('social_medias', function (Blueprint $table) {
            $table->increments('idSocial');
            $table->string('instagram');
            $table->string('facebook');
            $table->string('twitter');
            $table->integer('idEntitat')->references('id')->on('entitats');
            $table->timestamps();
        });
    }
}
