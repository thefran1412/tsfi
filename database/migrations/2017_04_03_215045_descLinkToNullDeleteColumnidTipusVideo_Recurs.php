<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DescLinkToNullDeleteColumnidTipusVideoRecurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE link_recurs MODIFY descLink VARCHAR(200);');
        DB::statement('DELETE FROM video_recurs WHERE idTipus IS NOT NULL ');
        DB::statement('ALTER TABLE video_recurs DROP idTipus;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DELETE FROM link_recurs WHERE descLink IS NULL;');
        DB::statement('ALTER TABLE link_recurs MODIFY descLink VARCHAR(200) NOT NULL ;');
        DB::statement('ALTER TABLE video_recurs ADD idTipus INT(11) NOT NULL;');
    }
}
