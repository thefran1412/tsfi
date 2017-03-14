<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    //
    protected $table = 'podcasts';
    protected $fillable = [
    'podcast_id', 'descPodCasts', 'podCast', 'ordre', 'idRecurs'];
}
