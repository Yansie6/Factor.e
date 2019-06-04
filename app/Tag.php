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
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_linked_tags');
    }

    /** ----------------------------------------------------
     * Many Tags belong to many Videos
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function videos()
    {
        return $this->belongsToMany(Video::class, 'videos_linked_tags');
        //return $this->belongsToMany(Video::class);
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
