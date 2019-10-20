<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'cart_item' , 'total',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(order::class);
    }

    public function cartItems(){
         // Parse Items And Return Array Of CartItem
         
    }

    public function inItems($product_id){
        // check if product id in items

    }
}
