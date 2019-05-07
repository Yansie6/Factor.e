<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** ----------------------------------------------------
     * Fillable
     * - The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'name',
    ];

    /** ----------------------------------------------------
     * Note
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function note()
    {
        return $this->hasMany('App\Note');
    }

    /** ----------------------------------------------------
     * Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function video()
    {
        return $this->hasMany('App\Video');
    }


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
     * GetQueueableRelations
     * - Get the relationships for the entity.
     *
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }
}
