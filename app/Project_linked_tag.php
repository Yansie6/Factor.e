<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_linked_tag extends Model
{
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
     * Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tag()
    {
        return $this->hasMany('App\Tag');
    }

    /** ----------------------------------------------------
     * GetQueueableRelations
     * - Get the relationships for the entity.
     *
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }
}
