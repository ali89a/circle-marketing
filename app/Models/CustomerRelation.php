<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicantname',
        'createdBy',
        'uplink',
        'issue_type',
        'client_type',
        'start_date',
        'issue_details',
        'user',
        'remark'
    ];
}