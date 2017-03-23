<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class alterTableRecursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('recursos', function(Blueprint $table) {
//            $table->string('descBreu')->nullable(true);
//        });
        DB::statement('ALTER TABLE recursos MODIFY subTitol VARCHAR(250) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descBreu MEDIUMTEXT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descDetaill1 LONGTEXT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descDetaill2 LONGTEXT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY relevancia int(11) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataInici DATE NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataFinal DATE NULL;');
        DB::statement('ALTER TABLE recursos MODIFY Gratuit TINYINT(1) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY preuInferior DOUBLE(15,2)	 NULL;');
        DB::statement('ALTER TABLE recursos MODIFY preuSuperior DOUBLE(15,2) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataPublicacio DATETIME NULL;');
        DB::statement('ALTER TABLE recursos MODIFY visible TINYINT(1) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY fotoResum VARCHAR(255) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY creatPer VARCHAR(255) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY idLocalitzacio INT(11) NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE recursos MODIFY subTitol VARCHAR(250) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descBreu MEDIUMTEXT NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descDetaill1 LONGTEXT NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descDetaill2 LONGTEXT NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY relevancia int(11) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataInici DATE NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataFinal DATE NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY Gratuit TINYINT(1) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY preuInferior DOUBLE(15,2)	 NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY preuSuperior DOUBLE(15,2) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataPublicacio DATETIME NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY visible TINYINT(1) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY fotoResum VARCHAR(255) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY creatPer VARCHAR(255) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY idLocalitzacio INT(11) NOT NULL;');

    }
}
