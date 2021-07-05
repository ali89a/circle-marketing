<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function items(){

        return $this->hasMany(InvoiceItem::class);

    }
    protected $fillable = [
       
        'order_id',  
        'billing_address',
        'invoice_no',
        'link_id',
        'invoice_date',
        'subject',
        'previous_due',
        'status',
        'core_rent',
        'otc',
        'vat',
       
    ];
}