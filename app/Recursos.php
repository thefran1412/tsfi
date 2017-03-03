<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recursos extends Model
{
    protected $table = 'recursos';
    protected $fillable = ['titol', 'subTitol', 'descDetaill1', 'relevancia', 'creatPer', 'created_at'];
}
