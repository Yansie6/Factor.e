<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video_note extends Model
{
    public function video()
    {
        return $this->belongsTo('App\Video');
    }
}
