<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Targets extends Model
{
    protected $table = 'targets';
    protected $primaryKey = 'targets_id';
    protected $fillable = ['targets_id', 'codiTarget', 'target'];
}
