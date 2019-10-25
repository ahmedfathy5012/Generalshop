<?php

namespace App\Http\Controllers\Api;
use App\Cart;
use App\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use App\product;
use Illuminate\Support\Facades\Auth;
use PhpParser\JsonDecoder;

class CartController extends Controller
{


    public function index(Request $request){
       $user = Auth::user();
       $cart = $user->cart;
       $cartItems = json_decode($cart->cart_item);
       $finalCartItems = [];
       foreach ($cartItems as $cartItem) {
           $product = product::find(intval($cartItem->product->id));
           $finalCartItem = new \stdClass();
           $finalCartItem->product = new ProductResource($product);
           $finalCartItem->qty = $cartItem->qty;
           array_push($finalCartItems, $finalCartItem);
       }
       return [
           'cart_items' => $finalCartItems,
           'id'         => $cart->id,
           'total'         => $cart->total,
       ];
    }


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
