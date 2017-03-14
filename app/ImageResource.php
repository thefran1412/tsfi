<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageResource extends Model
{
    //
    protected $table = 'imatge_recurs';
    protected $fillable = [
    'imatge_recurs_id', 'titolImatge', 'descImatge', 'imatge', 'ordre', 'idRecurs'];
}
