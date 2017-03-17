<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'localitzacions';
     protected $primaryKey = 'localitzacions_id';

    protected $fillable = [
    'localitzacions_id', 'latitud', 'longitud'];
}
