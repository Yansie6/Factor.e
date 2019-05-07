<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function video_note()
    {
        return $this->hasMany('App\Video_note'); 
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
