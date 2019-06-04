<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Video extends Model
{

    use HasApiTokens;

    /** ----------------------------------------------------
     * Fillable
     * - The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'name',
        'test_person',
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
     * Video has many tags
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
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
