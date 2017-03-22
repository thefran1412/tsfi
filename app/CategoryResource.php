<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryResource extends Model
{
    protected $table = 'categoria_recurs';
    protected $primaryKey = 'categoria_recurs_id';

    protected $fillable = [
    'categoria_recurs_id', 'idCategoria', 'idRecurs'];

}
