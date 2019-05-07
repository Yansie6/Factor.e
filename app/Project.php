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
     * Notes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    /** ----------------------------------------------------
     * Videos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
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
     * Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
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
