<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'categoria_id';

    protected $fillable = [
    'categoria_id', 'codiCategoria', 'descCategoria', 'nomCategoria'];

    public function resource(){
        return $this->belongsToMany('App\Resource','categoria_recurs','idCategoria','idRecurs');
        // ;
    }
}
