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
}
