<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FinalAndStartDateToDateTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE recursos MODIFY dataFinal DATETIME;');
        DB::statement('ALTER TABLE recursos MODIFY dataInici DATETIME;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE recursos MODIFY dataFinal DATE;');
        DB::statement('ALTER TABLE recursos MODIFY dataInici DATE;');
    }
}
