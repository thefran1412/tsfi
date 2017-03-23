<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_medias';
    protected $primaryKey = 'social_id';
    protected $fillable = ['social_id', 'instagram', 'facebook', 'twitter', 'idEntitat'];

	// public function socialMedia(){
 //        return $this->belongsTo('App\Entity','entitat_id');
 //    }
}