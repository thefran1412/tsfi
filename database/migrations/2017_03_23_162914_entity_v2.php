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
        DB::statement('ALTER TABLE entitats ADD facebook string;');
        DB::statement('ALTER TABLE entitats ADD twitter string;');
        DB::statement('ALTER TABLE entitats ADD facebook string;');

        DB::statement('DROP TABLE social_medias;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE entitats DROP facebook string;');
        DB::statement('ALTER TABLE entitats DROP twitter string;');
        DB::statement('ALTER TABLE entitats DROP facebook string;');

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
