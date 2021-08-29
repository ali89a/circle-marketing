<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNoc extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    protected $fillable=[
        'mrtg_graph_url',
        'username',
        'password',
        'device_description',
        'order_id',
      
    ];
    public function noc_items()
    {
        return $this->hasMany(OrderNocItem::class, 'order_noc_id');
    }
}
