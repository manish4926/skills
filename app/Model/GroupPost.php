<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupPost extends Model
{
    protected $table = 'groupposts';

    public function user()
    {
        return $this->hasOne('App\Model\User','id','posted_by');
    }

    public function getUser()
    {
        $query = $this->user()->first();
        return $query;
    }
}
