<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'admin_user_id', 'user_name', 'work_order_id', 'old_data',
    ];
    public function admin()
    {

        return $this->belongsTo('App\Models\Admin\Admin', 'admin_user_id');
    }
}
