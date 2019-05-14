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
     * Video has many Video_notes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function video_notes()
    {
        return $this->hasMany(Video_note::class);
    }

    /** ----------------------------------------------------
     * Video belongs to a Project
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
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
