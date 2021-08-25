<?php

namespace App\Models;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function supportTicket()
    {
        return $this->belongsTo(SupportTicket::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public function supportuser()
    {
        return $this->belongsTo(Admin::class,'support_id','id');
    }
}
