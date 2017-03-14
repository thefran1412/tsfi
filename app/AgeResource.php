<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgeResource extends Model
{
    //
    protected $table = 'edats_recurs';

    protected $fillable = ['edats_recurs_id', 'idEdat', 'idRecurs'];
}
