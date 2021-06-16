<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerServiceReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_report_id',
        'ctype',
        'isp_type',
        'visiting_card',
        'bandwidth',
        'rate',
        'otc',
        'remark',
        'audio',
    ];
}