<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_linked_tag extends Model
{
    public function tag()
    {
        return $this->hasMany('App\Tag');
    }
}
