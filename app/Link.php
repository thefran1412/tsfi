<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    protected $table = 'link_recurs';

    protected $fillable = [
    'link_recurs_id', 'descLink', 'link', 'idRecurs'];
}
