<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'recursos';

    protected $fillable = [
    'id', 'titol', 'subTitol', 'descBreu', 'descDetaill1', 'descDetaill2', 'relevancia', 'dataInici', 'DdtaFinal', 'Gratuit', 'preuInferior', 'preuSuperior', 'dataPublicacio', 'visible', 'fotoResum', 'creatPer', 'idLocalitzacio'];

    public function categoryResource(){
    	return $this->belongsTo('App\CategoryResource');
    }

    public function category(){
		return $this->belongsTo('App\Category');
    }

    public function entityResource(){
		return $this->belongsTo('App\EntityResource');
    }

    public function entity(){
		return $this->belongsTo('App\Entity');
    }
}
