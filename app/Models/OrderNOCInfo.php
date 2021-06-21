<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNOCInfo extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    protected $fillable=[
        'vlan_internet',
        'vlan_ggc',
        'vlan_fb',
        'vlan_bdix',
        'vlan_data',
        'ip_internet',

        'ip_ggc',
        'ip_fb',
        'ip_bdix',
        'ip_data',

        'assigned_bandwidth_internet',
        'assigned_bandwidth_ggc',
        'assigned_bandwidth_fb',
        'assigned_bandwidth_bdix',
        'assigned_bandwidth_data',

        'mrtg_graph_url',
        'username',
        'password',
        'device_description',
        'order_id',
      
    ];
}
