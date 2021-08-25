<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNocItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id', 'vlan', 'ip', 'assigned_brandwith', 'order_noc_id'
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
