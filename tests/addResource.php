<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\Recursos;

class addResource extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_notes_list()
    {
        //Having
        Recursos::create(['titol' => 'Test',
            'subTitol'=>'Test para probar creacion',
            'descDetaill1'=>'Estamos construyendo un buen sitio',
            'creatPer'=>'Nico'
        ]);
        // When
        $this->visit('resource/list')
            ->see('Test')
            ->see('Nico')
            ->see('Estamos construyendo un buen sitio')
            ->see('Test para probar creacion');
    }
    public function test_create_note(){

        $this->visit('notes')
            ->click('Add a Note')
            ->seePageIs('notes/create')
            ->see('Crea una nota')
            ->type('A new note','note')
            ->press('Create Note')
            ->seePageIs('notes')
            ->see('A new note')
            ->seeInDatabase('notes', [
                'note' => 'A new note'
            ]);

    }
}
