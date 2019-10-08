<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function  index(){
        return ProductResource::collection(product::paginate());
    }

    public function show($id){
        return new ProductResource(product::find($id));
    }
}
