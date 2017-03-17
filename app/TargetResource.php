<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetResource extends Model
{
    protected $table = 'target_recurs';
    protected $primaryKey = 'target_recurs_id';
    protected $fillable = ['target_recurs_id', 'idRecurs', 'idTarget'];
}
