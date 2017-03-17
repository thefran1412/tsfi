<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    //
    protected $table = 'podcasts';
     protected $primaryKey = 'podcast_id';
    protected $fillable = [
    'podcast_id', 'descPodCasts', 'podCast', 'ordre', 'idRecurs'];
}
