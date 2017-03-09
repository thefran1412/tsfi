<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    //
    protected $table = 'entitats';
    protected $fillable = ['id', 'nom', 'adreca', 'telf1', 'telf2', 'link', 'logo', 'desc', 'esMembre', 'idLocalitzacio'];
}
