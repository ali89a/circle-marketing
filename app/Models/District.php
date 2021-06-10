<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function division(){

        return $this->belongsTo('App\Division', 'division_id');

    }
    public function upazilas(){

        return $this->hasMany('App\Upazila', 'district_id');

    }
}
