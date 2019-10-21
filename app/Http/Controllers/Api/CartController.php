<?php

namespace App\Http\Controllers\Api;
use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProductToCart(Request $request){
           $user = Auth::user();
           $product_id = $request->input('product_id');
           $product    = product::findOrFail($product_id);
           $qty        = $request->input('qty');
           // Get The User Cart
           $cart = $this->checkCartStatus($user->cart);

           // Check If Product Already In Cart
           if($cart->inItems($product_id)){
           // If Exists qty++
           $cart->increaseProductInCart($product , $qty);
           }else{
           // Else Add To Cart
               $cart->addProductToCart($product , $qty);
           }
           $cart->save();
           // Return Response
        return new CartResource();
    }


    private function checkCartStatus(Cart $cart){
        if(is_null($cart)){
           $cart = new Cart;
           $cart->cart_item = [];
           $cart->total = 0 ;
        }
        return $cart;
    }
}
