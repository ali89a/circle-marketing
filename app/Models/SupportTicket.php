<?php

namespace App\Models;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


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

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public function supportuser()
    {
        return $this->belongsTo(Admin::class,'support_id','id');
    }



    public function ticketComments()
    {
        return $this->hasMany(TicketComment::class,'ticket_id','id');
    }


}
