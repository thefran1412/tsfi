<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableNullValuesResources extends Migration
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

        DB::statement('ALTER TABLE recursos MODIFY subTitol varchar(250) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descBreu varchar(500) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descDetaill1 varchar(255) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descDetaill2 varchar(255) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY relevancia int(11) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataInici date NULL;');
        DB::statement('ALTER TABLE recursos MODIFY DdtaFinal date NULL;');
        DB::statement('ALTER TABLE recursos MODIFY Gratuit tinyint(1) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY preuInferior double(15,2)	 NULL;');
        DB::statement('ALTER TABLE recursos MODIFY preuSuperior double(15,2) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataPublicacio datetime NULL;');
        DB::statement('ALTER TABLE recursos MODIFY visible tinyint(1) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY fotoResum varchar(255) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY creatPer varchar(255) NULL;');
        DB::statement('ALTER TABLE recursos MODIFY idLocalitzacio int(11) NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DELETE FROM recursos WHERE (subTitol IS NULL OR subTitol = "")AND (descBreu IS NULL OR descBreu = "")
        AND (descDetaill1 IS NULL OR descDetaill1 = "")AND (descDetaill2 IS NULL OR descDetaill2 = "")AND relevancia IS NULL
        AND dataInici IS NULL AND DdtaFinal IS NULL AND Gratuit IS NULL AND (preuInferior IS NULL OR preuInferior = 0)
        AND (preuSuperior IS NULL OR preuSuperior = 0) AND dataPublicacio IS NULL AND visible IS NULL AND (fotoResum IS NULL OR fotoResum = "")
        AND (creatPer IS NULL OR creatPer = "") AND (idLocalitzacio IS NULL OR idLocalitzacio = 0);');

        DB::statement('ALTER TABLE recursos MODIFY subTitol varchar(250) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descBreu varchar(500) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descDetaill1 varchar(255) NOT  NULL;');
        DB::statement('ALTER TABLE recursos MODIFY descDetaill2 varchar(255) NOT  NULL;');
        DB::statement('ALTER TABLE recursos MODIFY relevancia int(11) NOT  NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataInici date NOT  NULL;');
        DB::statement('ALTER TABLE recursos MODIFY DdtaFinal date  NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY Gratuit tinyint(1) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY preuInferior double(15,2) NOT  NULL;');
        DB::statement('ALTER TABLE recursos MODIFY preuSuperior double(15,2) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY dataPublicacio datetime NOT  NULL;');
        DB::statement('ALTER TABLE recursos MODIFY visible tinyint(1) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY fotoResum varchar(255) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY creatPer varchar(255) NOT NULL;');
        DB::statement('ALTER TABLE recursos MODIFY idLocalitzacio int(11) NOT NULL;');

    }
}
