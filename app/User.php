<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /** ----------------------------------------------------
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'rank',
        'company_id',
    ];

    /** ----------------------------------------------------
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** ----------------------------------------------------
     * User belongs to a Project
     *
     */
    /*public function Project()
    {
        return $this->belongsTo(User::class);
    }*/

    /** ----------------------------------------------------
     * Many Users belong to many Projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function Projects()
    {
        return $this->belongsToMany(Video::class, 'projects_linked_users');
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
