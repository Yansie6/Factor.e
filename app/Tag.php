<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** ----------------------------------------------------
     * Fillable
     * - The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag',
    ];

    /** ----------------------------------------------------
     * Project_linked_tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function project_linked_tag()
    {
        return $this->hasMany('App\Project_linked_tag');
    }

    /** ----------------------------------------------------
     * Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function project()
    {
        return $this->belongsToMany('App\Project');
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
