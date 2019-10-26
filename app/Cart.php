<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'cart_item' , 'total', 'user_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(order::class);
    }


    public function addProductToCart(product $product , $qty = 1){
        $cartItems = $this->cart_item;
        if(is_null($cartItems)){
            $cartItems = [];
        }else{
            if(!is_array($cartItems)){
                $cartItems = json_decode($cartItems);
            }
        }
        /**
         * @var $cartItem CartItem
         */
          $cartItem = new CartItem($product , 1);
          array_push($cartItems,$cartItem);
          $this->cart_item = json_encode($cartItems);
          $tempTotal = 0;
          foreach($cartItems as $cartItem){
              $tempTotal += ($cartItem->qty * $cartItem->product->price); 
          }
          $this->total = $tempTotal ;
    }

    public  function increaseProductInCart(product $product , $qty = 1){
        $cartItems = $this->cart_item;
        if(is_null($cartItems)){
            $cartItems = [];
        }else{
            if(!is_array($cartItems)){
                $cartItems = json_decode($cartItems);
            }
        }
      /**
       * @var $cartItem CartItem
       */
      foreach ($cartItems as $cartItem){
           if($cartItem->product->id === $product->id){
               $cartItem->qty += $qty;
           }
      }
        $this->cart_item = json_encode($cartItems);
        $tempTotal = 0;
        foreach($cartItems as $cartItem){
            $tempTotal += ($cartItem->qty * $cartItem->product->price); 
        }
        $this->total = $tempTotal ;
    }

    public function inItems($product_id){
        // check if product id in items
        $cartItems = $this->cart_item;
        if(is_null($cartItems)){
            $cartItems = [];
        }else{
          if(!is_array($cartItems)){
              $cartItems = json_decode($cartItems);
          }
        }
        /**
         * @var $cartItem CartItem
         */
        foreach($cartItems as $cartItem){
          if($product_id == $cartItem->product->id){
              return true;
          }
        }
        return false;
    }
}
