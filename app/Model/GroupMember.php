<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $table = 'group_members';

    public function groups()
    {
        return $this->belongsToMany('App\Model\Group','group_id','group_id');
    }

    public function user()
    {
        return $this->hasOne('App\Model\User','id','user_id');
    }

    public function userprofile()
    {
        return $this->hasOne('App\Model\User','id','posted_by');
    }

    public function getUser()
    {
        $query = $this->user()->first();
        return $query;
    }

    public function getUserProfile()
    {
        $query = $this->userprofile()->first();
        return $query;
    }

}
