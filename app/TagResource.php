<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagResource extends Model
{
    protected $table = 'tag_recurs';
    protected $primaryKey = 'tag_recurs_id';
    protected $fillable = [
    'tag_recurs_id', 'idTag', 'idRecurs'];
}
