<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmWorkLimit extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'blimit',
        'mlimit',
        'climit',
        'llimit'
    ];
}