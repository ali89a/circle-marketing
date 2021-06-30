<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderApproval extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function m_user()
    {
        return $this->belongsTo('App\Models\Admin\Admin', 'm_approved_by','id');
    }
    public function noc_user()
    {
        return $this->belongsTo('App\Models\Admin\Admin', 'noc_approved_by','id');
    }
    public function noc_assign_user()
    {
        return $this->belongsTo('App\Models\Admin\Admin', 'noc_assigning_by','id');
    }
}
