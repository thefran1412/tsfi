<?php

use Illuminate\Database\Seeder;

class fakeRecursos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Recursos::class)->times(10)->create();
    }
}
