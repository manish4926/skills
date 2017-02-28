<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Newsfeed extends Model
{
    //Groups,Scholarships,Internships,Follow Persons and Posts Followed User if Possible

    public function user()
    {
        return $this->hasOne('App\Model\User','id','userid');
    }

    public function group()
    {
        return $this->hasOne('App\Model\Group','group_id','typeid');
    }

    public function scholarship()
    {
        return $this->hasOne('App\Model\Scholarship','id','typeid');
    }

    public function internship()
    {
        return $this->hasOne('App\Model\Internship','id','typeid');
    }

    public function follow()
    {
        return $this->hasOne('App\Model\User','id','typeid');
    }

    public function post_admin()
    {
        $query = $this->user()->first();
        return $query;
    }

    public function get_group()
    {
        $query = $this->group()->first();
        return $query;
    }

    public function get_scholarship()
    {
        $query = $this->scholarship()->first();
        return $query;
    }

    public function get_internship()
    {
        $query = $this->internship()->first();
        return $query;
    }

    public function get_follower()
    {
        $query = $this->follow()->first();
        return $query;
    }

}
