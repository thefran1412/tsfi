<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE entitats ADD deleted tinyint(1);');
        DB::statement('ALTER TABLE tags ADD deleted tinyint(1);');
        DB::statement('ALTER TABLE categories ADD deleted tinyint(1);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE entitats DROP facebook tinyint(1);');
        DB::statement('ALTER TABLE tags DROP deleted tinyint(1);');
        DB::statement('ALTER TABLE categories DROP deleted tinyint(1);');
    }
}