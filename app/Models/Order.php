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
    public function user()
    {
        return $this->belongsTo('App\Models\Admin\Admin', 'creator_user_id','id');
    }
    public function order_approval()
    {

        return $this->hasOne('App\Models\OrderApproval', 'order_id');
    }
    public function order_info()
    {

        return $this->hasOne('App\Models\OrderInfo', 'order_id');
    }
}
