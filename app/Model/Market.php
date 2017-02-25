<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    protected $table = 'market';

    public function admin()
    {
        return $this->hasOne('App\Model\User','id','posted_by');
    }

    public function post_admin()
    {
        $query = $this->admin()->first();
        return $query;
    }
}
