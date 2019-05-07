<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    /** ----------------------------------------------------
     * Fillable
     * - The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'name',
        'link',
    ];

    /** ----------------------------------------------------
     * Video_note
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function video_note()
    {
        return $this->hasMany('App\Video_note'); 
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
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
