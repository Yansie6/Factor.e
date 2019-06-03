<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_linked_user extends Model
{
    protected $table = 'projects_linked_users';
    public $timestamps = false;

    /** ----------------------------------------------------
     * Fillable
     * - The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'project_id',
    ];

    /** ----------------------------------------------------
     * Project_linked_user has many Projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /** ----------------------------------------------------
     * Project_linked_user has many Users
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
