<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function customer_details()
    {

        return $this->hasOne('App\Models\OrderCustomerInfo', 'order_id');
    }
    public function customer()
    {

        return $this->belongsTo('App\Models\User', 'customer_id');
    }
}
