<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;


    public function status()
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriorities::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'customer_id','id');
    }


}
