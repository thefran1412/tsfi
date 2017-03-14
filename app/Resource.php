<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'recursos';

    protected $fillable = [
    'id', 'titol', 'subTitol', 'descBreu', 'descDetaill1', 'descDetaill2', 'relevancia', 'dataInici', 'DdtaFinal', 'Gratuit', 'preuInferior', 'preuSuperior', 'dataPublicacio', 'visible', 'fotoResum', 'creatPer', 'idLocalitzacio'];

    public function age(){
        return $this->belongsTo('App\Age');
    }
    public function ageResource(){
        return $this->belongsTo('App\AgeResource');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function categoryResource(){
        return $this->belongsTo('App\CategoryResource');
    }
    public function entity(){
        return $this->belongsTo('App\Entity');
    }
    public function entityResource(){
        return $this->belongsTo('App\EntityResource');
    }
    public function imageResource(){
        return $this->belongsTo('App\ImageResource');
    }
    public function link(){
        return $this->belongsTo('App\Link');
    }
    public function localitzacion(){
        return $this->belongsTo('App\Localitzation');
    }
    public function podcast(){
        return $this->belongsTo('App\Podcast');
    }
    public function socialMedia(){
        return $this->belongsTo('App\SocialMedia');
    }
    public function tag(){
        return $this->belongsTo('App\Tag');
    }
    public function tagResource(){
        return $this->belongsTo('App\TagResource');
    }
    public function target(){
        return $this->belongsTo('App\Target');
    }
    public function targetResource(){
        return $this->belongsTo('App\TargetResource');
    }
    public function videoResource(){
        return $this->belongsTo('App\VideoResource');
    }
    public function videoType(){
        return $this->belongsTo('App\VideoType');
    }
}
