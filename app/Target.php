<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = 'targets';
    protected $primaryKey = 'target';
    protected $fillable = ['targets_id', 'codiTarget', 'target'];
}
