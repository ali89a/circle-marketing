<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public function districts(){

        return $this->hasMany('App\District', 'division_id');

    }
}
