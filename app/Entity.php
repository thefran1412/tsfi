<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    //
    protected $table = 'entitats';
    protected $primaryKey = 'entitat_id';
    protected $fillable = ['entitat_id', 'nomEntitat', 'adreca', 'telf1', 'telf2', 'link', 'logo', 'descRecurs', 'esMembre', 'idLocalitzacio'];
    
    public function resource(){
        return $this->belongsToMany('App\Resource','entitat_recurs','idEntitat','idRecurs');
    }
    
    public function socialMedia(){
        return $this->hasMany('App\SocialMedia','idEntitat');
    }
}