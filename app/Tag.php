<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function project_linked_tag()
    {
        return $this->hasMany('App\Project_linked_tag');
    }
}
