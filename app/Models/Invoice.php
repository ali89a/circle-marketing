<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'order_id',  
        'billing_address',
        'invoice_no',
        'link_id',
        'invoice_date',
        'subject',
        'previous_due',
       
    ];
}