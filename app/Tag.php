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
     * Many Tags belong to many Projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function Projects()
    {
        return $this->belongsToMany(Project::class, 'projects_linked_tags');
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
