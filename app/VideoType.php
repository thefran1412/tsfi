<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoType extends Model
{
    protected $table = 'tipus_videos';
    protected $fillable = ['tipus_videos_id', 'plataforma', 'codiPlataforma'];
}
