<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    protected $table = 'link_recurs';
     protected $primaryKey = 'links_recurs_id';

    protected $fillable = [
    'link_recurs_id', 'descLink', 'link', 'idRecurs'];
}
