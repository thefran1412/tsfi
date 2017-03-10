<?php

use Illuminate\Database\Seeder;

class imageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ImageResource::class)->times(10)->create();
    }
}
