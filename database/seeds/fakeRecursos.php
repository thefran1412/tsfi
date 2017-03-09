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
        factory(\App\Resource::class)->times(10)->create();
    }
}
