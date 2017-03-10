<?php

use Illuminate\Database\Seeder;

class fakeCategoryResource extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\CategoryResource::class)->times(10)->create();
    }
}
