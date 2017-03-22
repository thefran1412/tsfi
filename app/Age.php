<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    //
    protected $table = 'edats';
    protected $primaryKey = 'edats_id';

    protected $fillable = ['edats_id', 'codiEdat', 'descEdat'];

    public function resource(){
    	return $this->belongsToMany('App\Resource','edats_recurs','idEdat','idRecurs');
    }
}
