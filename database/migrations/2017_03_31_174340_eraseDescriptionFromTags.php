<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EraseDescriptionFromTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE tags MODIFY descTag VARCHAR(255);');
        DB::statement('UPDATE tags SET descTag = NULL WHERE descTag IS NOT NULL;');
        DB::statement('ALTER TABLE tsfi.tags DROP descTag;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE tags ADD descTag VARCHAR(255) DEFAULT NULL  NULL;');
    }
}
