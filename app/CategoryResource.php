<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryResource extends Model
{
    protected $table = 'categoria_recurs';

    protected $fillable = [
    'id', 'idCategoria', 'idRecurs'];

}
