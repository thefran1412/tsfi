<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'tags_id';
     protected $fillable = [
    'tags_id', 'nomTags', 'descTag'];
}
