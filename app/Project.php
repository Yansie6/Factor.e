<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function note()
    {
        return $this->hasMany('App\Note');
    }

    public function video()
    {
        return $this->hasMany('App\Video');
    }

    public function project_linked_tag()
    {
        return $this->hasMany('App\Project_linked_tag');
    }
}
