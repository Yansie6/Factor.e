<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_linked_tag extends Model
{
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
