<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgeResource extends Model
{
    //
    protected $table = 'edats_recurs';
    protected $primaryKey = 'edats_recurs_id';

    protected $fillable = ['edats_recurs_id', 'idEdat', 'idRecurs'];
}
