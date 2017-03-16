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

    public function category(){
        return $this->hasMany('App\Category','categoria_id');
    }

    public function categoryResource(){
        return $this->hasMany('App\EntityResource','idRecurs');
    }

    public function age(){
    	return $this->hasMany('App\Age');
    }

    public function ageResource(){
        return $this->hasMany('App\AgeResource');
    }

    public function entity(){
		return $this->hasMany('App\Entity','entitat_id');
    }

    public function entityResource(){
        return $this->hasMany('App\EntityResource','idRecurs');
    }

    public function imageResource(){
        return $this->hasMany('App\ImageResource', 'imatge_recurs_id');
    }

    public function link(){
        return $this->hasMany('App\Link');
    }

    public function location(){
        return $this->hasMany('App\Location');
    }

    public function podcast(){
        return $this->hasMany('App\Podcast');
    }

    public function resource(){
        return $this->hasMany('App\Resource');
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

    public function targets(){
        return $this->hasMany('App\Targets', 'targets_id');
    }

    public function targetResource(){
        return $this->hasMany('App\TargetResource', 'idRecurs');
    }

    public function videoType(){
        return $this->hasMany('App\VideoType');
    }

    public function videoResource(){
        return $this->hasMany('App\VideoResource');
    }
}
