<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Session;
class CategoryController extends Controller
{
    public function index(){
     $categories = Category::paginate(env("PAGINATION_COUNT"));
     return view('admin.categories.categories')->with([
         'categories'=>$categories,
         'showLinks' => true,
     ]);
    }
    

    private function categoryNameExists($categoryName){
        $category = Category::where(
            'category_name','=',$categoryName
        )->first();
        if($category){          
            return true;
        }
        return false;
      }

    public function store(Request $request){
        dd($request);
        $request->validate([
            'category_name' =>   'required',
            'category_image' =>  'required',
            'image_direction' => 'required',
        ]);
        $category_name = $request->input('category_name');
        if($this->categoryNameExists($category_name)){
        Session::flash('message','Category Name ('.$category_name.') already exists');
        return redirect()->back();
        }
        $category = new Category();
        $category->name = $category_name;
        $category->imag_direction =$request->input('image_direction');
        

        if($request->hasFile('category_image')){
            
            $image = $request->file('category_image');           
             $path = $image->store('public');
             $category->image_url =$path;
        }
       
        $category->save();
        Session::flash('message','Category ('.$category_name.') has been added');
        return redirect()->back();
    }


    public function update(Request $request){
        $request->validate([
            'category_id' => 'required',
            'category_name' => 'required',
        ]);
        $category_name = $request->input('category_name');
        if($this->categoryNameExists($category_name)){
            Session::flash('message','Category Name ('.$category_name.') already exists');
            return redirect()->back();
        }
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);
        $category->category_name = $category_name ;
        $category->save();
        Session::flash('message','Category has been updated');
        return redirect()->back();
        
    }


    public function delete(Request $request){
        $request->validate([
            'category_id' => 'required'
        ]);
        $catID = $request->input('category_id');
        Category::destroy($catID);
        Session::flash('message','Category has been deleted');
        return redirect()->back();
    }


    public function search(Request $request){
        $request->validate([
            'category_search' => 'required'
        ]);
        $searchTerm = $request->input('category_search');
 
        $categories  = Category::where(
            'category_name' , 'LIKE' , '%' . $searchTerm . '%' 
        )->get();
 
        if(count($categories)>0){
            return view('admin.categories.categories')->with([
                'categories' => $categories,
                'showLinks' => false,
            ]);
        }
 
        Session::flash('message','Nothing Found !!');
        return redirect()->back();
    }
}
