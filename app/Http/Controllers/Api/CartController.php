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
           $request->validate([
               'product_id' => 'required',
               'qty'        => 'required',
           ]);
           $user = Auth::user();
           $product_id = $request->input('product_id');
           $product    = product::findOrFail($product_id);
           $qty        = $request->input('qty');
           // Get The User Cart
           $cart = $user->cart;
           if(is_null($cart)){
               $cart = new Cart();
               $cart->cart_item = [];
               $cart->total = 0 ;
               $cart->user_id = Auth::user()->id;

           }
           // Check If Product Already In Cartreturn [
           if($cart->inItems($product_id)){
           // If Exists qty++
           $cart->increaseProductInCart($product , $qty);
           }else{
           // Else Add To Cart
             $cart->addProductToCart($product , $qty);
           }

            $cart->save();
           $user->cart_id = $cart->id;
           $user->save();
           return $cart;
           // Return Response

    }



}
