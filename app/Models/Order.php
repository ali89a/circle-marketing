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
    public function customer_doc()
    {

        return $this->hasOne('App\Models\OrderCustomerDocument', 'order_id');
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
    public function noc()
    {

        return $this->hasOne('App\Models\OrderNOCInfo', 'order_id');
    }
    public function order_items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }
    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice', 'order_id');
    }
    public function upagrate()
    {
        return $this->hasMany('App\Models\Invoice', 'order_id');
    }
    public function downgrations()
    {
        return $this->hasMany('App\Models\OrderDowngration', 'order_id');
    }
    public function upgrations()
    {
        return $this->hasMany('App\Models\OrderUpgration', 'order_id');
    }
}
