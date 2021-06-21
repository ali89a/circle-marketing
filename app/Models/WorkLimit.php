<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkLimit extends Model
{
    use HasFactory;
    protected $fillable=[
        'admin_id',
        'newclient',
        'followup',
        'reconnect'
    ];
}