<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role','user_role','user_id','role_id');
    }


    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach ($roles as $role) {
                if($this->hasRole($role)) {
                    return true;
                }
            }
        }
        else{
            if($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if($this->roles()->where('name',$role)->first()) {
            return true;
        }
        return false;
    }
    public function user_roles()
    {
        $query = $this->roles()->first();
        return $query;
    }

    public function profile()
    {
        return $this->hasOne('App\Model\UserProfile','user_id','id');
    }

    public function user_profile()
    {
        $query = $this->profile()->first();
        return $query;
    }

    public function follower()
    {
        return $this->hasMany('App\Model\Follower','user_id','id');
    }

    public function getfollowers($id)
    {
        $query = $this->follower()->where('follower_id','=',$id)->count();
        return $query;
    }
}
