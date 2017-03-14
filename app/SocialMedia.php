<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_medias';
    protected $fillable = [
    'social_id', 'instagram', 'facebook', 'twitter', 'idEntitat'];
}
