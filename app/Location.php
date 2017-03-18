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

    public function resource(){
        return $this->hasOne('App\Resource','idLocalitzacio');
    }
    
    public function entity(){
        return $this->hasOne('App\Entity','idLocalitzacio');
    }
}
