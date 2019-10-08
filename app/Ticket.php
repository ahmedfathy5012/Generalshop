<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id' , 'order_id' , 'title' , 'message',
        'status' , ' tickettype_id'
    ];



    public function tickettype(){
        return $this->belongsTo(TicketType::class);
    }



    public function customer(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function order(){
        return $this->belongsTo(order::class);
    }

}
