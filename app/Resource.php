<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'recursos';
    protected $primaryKey = 'recurs_id';
    public $timestamps = false;

    protected $fillable = [
    'recurs_id', 'titolRecurs', 'subTitol', 'descBreu', 'descDetaill1', 'descDetaill2', 'relevancia', 'dataInici', 'dataFinal', 'gratuit', 'preuInferior', 'preuSuperior', 'dataPublicacio', 'visible', 'fotoResum', 'creatPer', 'idLocalitzacio'];

    public function age(){
    	return $this->hasMany('App\CategoryResource');
    }
    public function ageResource(){
        return $this->belongsTo('App\AgeResource');
    }
    public function category(){
		return $this->hasMany('App\Category');
    }
    public function categoryResource(){
        return $this->belongsTo('App\CategoryResource');
		return $this->hasMany('App\EntityResource');
    }
    public function entity(){
		return $this->hasMany('App\Entity');
    }

    public function targetResource(){
        return $this->hasMany('App\TargetResource');
    }

    public function targets(){
        return $this->hasMany('App\Targets');
    }

    public function age(){
        return $this->hasMany('App\Age');
    }

    public function ageResource(){
        return $this->hasMany('App\AgeResource');
    }

    public function link(){
        return $this->hasMany('App\Link');
    }

    public function imageResource(){
        return $this->hasMany('App\ImageResource');
    }

    public function location(){
        return $this->hasMany('App\Location');
    }

    public function podcast(){
        return $this->hasMany('App\Podcast');
    }

    public function socialMedia(){
        return $this->hasMany('App\SocialMedia');
    }

    public function tag(){
        return $this->hasMany('App\Tag');
    }

    public function tagResource(){
        return $this->hasMany('App\TagResource');
    }

    public function videoResource(){
        return $this->hasMany('App\VideoResource');
    }

    public function videoType(){
        return $this->hasMany('App\VideoType');
    }
}
