<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_linked_tag extends Model
{
    protected $table = 'projects_linked_tags';
    public $timestamps = false;

    /** ----------------------------------------------------
     * Fillable
     * - The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_id',
        'project_id',
    ];
    
    /** ----------------------------------------------------
     * Project_linked_tag has many Projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /** ----------------------------------------------------
     * Project_linked_tag has many Tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
