<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDowngration extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
