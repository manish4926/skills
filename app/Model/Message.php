<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user()
    {
        return $this->hasOne('App\Model\User','id','target_id');
    }


    public function getUser()
    {
        $query = $this->user()->first();
        return $query;
    }
}
