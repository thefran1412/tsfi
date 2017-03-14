<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
    'categoria_id', 'codiCategoria', 'descCategoria', 'nomCategoria'];
}
