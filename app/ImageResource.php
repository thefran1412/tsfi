<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageResource extends Model
{
    //
    protected $table = 'imatge_recurs';
    protected $primaryKey = 'imatge_recurs_id';
    protected $fillable = [
    'imatge_recurs_id', 'titolImatge', 'descImatge', 'imatge', 'ordre', 'idRecurs'];

    public function resource(){
        return $this->belongsTo('App\Resource');
    }
}
