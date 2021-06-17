<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReport extends Model
{
    use HasFactory;
    
    protected $fillable=[ 
        'createdBy', 
        'contact_number', 
        'cname', 
        'location_district', 
        'location_upazila', 
        'address', 
        'contact_person', 
        'email', 
        //'visit_phone', 
       
    ];
}