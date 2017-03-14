<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetResource extends Model
{
    protected $table = 'target_recurs';
    protected $fillable = ['target_recurs_id', 'idRecurs', 'idTarget'];
}
