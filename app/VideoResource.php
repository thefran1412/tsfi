<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoResource extends Model
{
    protected $table = 'video_recurs';
    protected $fillable = [
    'video_recurs_id', 'idTipus', 'idRecurs', 'urlVideo', 'titolVideoRecurs'];
}
