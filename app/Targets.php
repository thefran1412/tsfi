<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Targets extends Model
{
    protected $table = 'targets';
    protected $fillable = ['id', 'codi', 'target'];
}
