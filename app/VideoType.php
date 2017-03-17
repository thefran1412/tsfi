<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoType extends Model
{
    protected $table = 'tipus_videos';
    protected $primaryKey = 'tipus_videos_id';
    protected $fillable = ['tipus_videos_id', 'plataforma', 'codiPlataforma'];
}
