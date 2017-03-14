<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntityResource extends Model
{
    //
    protected $table = 'entitat_recurs';
    protected $fillable = [
    'entitat_recurs_id', 'idEntitat', 'idRecurs'];
}
