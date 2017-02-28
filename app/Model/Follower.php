<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    public function user()
    {
        return $this->hasOne('App\Model\User','id','user_id');
    }


    public function getUser()
    {
        $query = $this->user()->first();
        return $query;
    }

    public function follower()
    {
        return $this->hasOne('App\Model\User','id','follower_id');
    }


    public function getFollower ()
    {
        $query = $this->follower()->first();
        return $query;
    }

    public function profile()
    {
        return $this->hasOne('App\Model\UserProfile','user_id','user_id');
    }

    public function user_profile()
    {
        $query = $this->profile()->first();
        return $query;
    }

    public function followerprofile()
    {
        return $this->hasOne('App\Model\UserProfile','user_id','follower_id');
    }

    public function follower_profile()
    {
        $query = $this->followerprofile()->first();
        return $query;
    }

}
