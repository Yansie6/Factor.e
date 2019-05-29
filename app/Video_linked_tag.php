<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video_linked_tag extends Model
{
    protected $table = 'videos_linked_tags';
    public $timestamps = false;

    /** ----------------------------------------------------
     * Fillable
     * - The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'video_id',
        'tag_id',
    ];

    /** ----------------------------------------------------
     * Video_linked_tag has many Projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function projects()
    {
        return $this->hasMany(Video::class);
    }

    /** ----------------------------------------------------
     * Video_linked_tag has many Tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
