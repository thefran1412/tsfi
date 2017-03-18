<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = 'targets';
    protected $primaryKey = 'targets_id';
    protected $fillable = ['targets_id', 'codiTarget', 'target'];
}
