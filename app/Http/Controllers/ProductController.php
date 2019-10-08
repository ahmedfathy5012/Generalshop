<?php

namespace App\Http\Controllers;
use App\product;
use App\Unit;
use App\Category;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Session;

class ProductController extends Controller
{
    public function index(){
    $products = product::with(['category','images','hasUnit'])->paginate(env("PAGINATION_COUNT"));
    $currencyCode = env("CURRENCY_CODE" , "$"); 
    return view('admin.products.products')->with([
        'products'=>$products,
        'currency_code'=>$currencyCode,
    ]);
    }


    private function writeProduct(Request $request , product $product , $update = false){
        $product->title=$request->input('product_title');
        $product->description=$request->input('product_description');
        $product->unit=intval($request->input('product_unit'));
        $product->price=doubleval($request->input('product_price'));
        $product->discount=doubleVal($request->input('product_discount'));
        $product->total=doubleval($request->input('product_total'));
        $product->category_id=intval($request->input('product_category'));
        
        if($request->has('options')){
            
            $optionArray = [];
            $options = array_unique($request->input('options'));
            foreach($options as $option){
                $optionArray[$option] = [];
                $actualOptions = $request->input('option');
                
                foreach ($actualOptions as $actualOption) {
                   array_push($optionArray[$option] , $actualOption);
                }
            }
            $product->options = json_encode($optionArray);
        }

        $product->save();

        if($request->hasFile('product_images')){
            
            $images = $request->file('product_images');
           
            foreach($images as $image){
             $path = $image->store('public');
             $image = new Image();
             $image->url = $path ;
             $image->product_id = $product->id;
             $image->save();
            }
        }

        return $product;
    }


    public function store(Request $request){
        $request->validate([
            'product_title' => 'required',
            'product_description' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required',
            'product_discount' => 'required',
            'product_total' => 'required',
            'product_category' => 'required',
        ]);
        
       
        
        $product = new product();
        $this->writeProduct($request,$product);
        
        Session::flash('message','Product Has Added');
        return redirect(route('products'));
    }

    


    
    public function delete($id){

    }


    
    public function update(Request $request){
        $request->validate([
            'product_title' => 'required',
            'product_description' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required',
            'product_discount' => 'required',
            'product_total' => 'required',
            'product_category' => 'required',
        ]);
        $productID = $request->input('product_id');
        $product = product::find($productID);
        
        $this->writeProduct($request,$product,true);
        
        Session::flash('message','Product Has been updated');
        return back();
    }


    
    public function newProduct($id = null){
        $product = null;
        if(!is_null($id)){
            $product = product::with(
                [
                    'hasUnit',
                    'category',
                    'images'
                ]
            )->find($id);           
        }
       
        $units = Unit::all();
        $categories = Category::all();
        return view('admin.products.new-product')->with(
            [
                'units' => $units,
                'product' => $product , 
                'categories' => $categories,
              
            ]
        );       
    }



    public function deleteImage(Request $request){
       
        $imagID = $request->input('image_id');
        Image::destroy($imagID);
    }
}
