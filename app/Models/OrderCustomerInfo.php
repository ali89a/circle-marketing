<?php

namespace App\Models;

use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCustomerInfo extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'customer_id','id');
    }
    public function division(){
        return $this->belongsTo(Division::class,'division_id');
    }
    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
    public function upazila(){
        return $this->belongsTo(Upazila::class,'upazila_id');
    }
}
