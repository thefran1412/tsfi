<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    //
    protected $table = 'edats';

    protected $fillable = ['edats_id', 'codiEdat', 'descEdat'];
}
