<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    public function members()
    {
        return $this->hasMany('App\Model\GroupMember','group_id','group_id');
    }

    public function groupmembers()
    {
        $query = $this->members()->orderBy('id', 'desc')->first();
        return $query;
    }
}
