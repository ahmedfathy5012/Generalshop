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
        if(is_null($this->cart_item)){
            $this->cart_item= [];
            return $this->cart_item;
        }
        return json_decode($this->cart_item);
    }


    public function addProductToCart(product $product , $qty = 1){
         $cartItems = $this->cartItems();
        /**
         * @var $cartItem CartItem
         */
          array_push($cartItems,$cartItem);
    }

    public  function increaseProductInCart(product $product , $qty = 1){
      $cartItems = $this->cartItems();
      /**
       * @var $cartItem CartItem
       */
      foreach ($cartItems as $cartItem){
           if($cartItem->product->id === $product->id){
               $cartItem->qty += $qty;
           }
      }
    }

    public function inItems($product_id){
        // check if product id in items
        $cartItems = $this->cartItems();
        /**
         * @var $cartItem CartItem
         */
        foreach($cartItems as $cartItem){
          if($product_id === $cartItem->product->id){
              return true;
          }
        }
        return false;
    }
}
