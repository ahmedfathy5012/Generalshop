@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">

                     <form action="{{route('categories')}}" method="post" class="row" enctype="multipart/form-data">
                           @csrf
                                <div class="form-group col-md-6">
                                      <label for="category_name">Category Name</label>
                                      <input type="text" class="form-control" id="category_name" name= "category_name" placeholder="Category Name" required>
                                </div>
                               

                                <div class="form-group col-md-6">
                                  <label for="category_image">Category Image</label>
                                  <input type="file" class="form-control-file" id="category_image" name= "category_image"  required>
                                </div>


                                <div class="form-group col-md-6">
                                  <label for="category_image">Image Direction</label>
                                 
                               {{--   <div class="form-check">
                                        <input type="radio" class="form-check-input" name="image_direction" id="exampleRadios1" value="left" checked>
                                        <label for="exampleRadios" class="form-check-input">
                                          Left
                                        </label>
                                     </div>
     
                                     <div class="form-check">
                                         <input type="radio" class="form-check-input" name="image_direction" id="exampleRadios2" value="right">
                                         <label for="exampleRadios" class="form-check-input">
                                           Right
                                         </label>
                                      </div> --}}


                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="image_direction" id="exampleRadios1" value="left" checked>
                                          <label class="form-check-label" for="exampleRadios1">
                                            Left
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="image_direction" id="exampleRadios2" value="right">
                                          <label class="form-check-label" for="exampleRadios2">
                                            Right
                                          </label>
                                        </div>
                                    
                                        
                                    
                                </div>


                              <div class="form-group col-md-12">
                                 <button type="submit" class="btn btn-primary">Save New Category</button>
                              </div>
                           </form>

                   <div class="row">
                        @foreach ($categories as $category)
                    <div class="col-md-3">
                     <div class="alert alert-primary" role="alert">
                           <span class="buttons-span"> 

                                 <span>
                                   <a class="edit-category" 
                                      data-categoryname="{{$category->category_name}}"
                                      data-categoryid="{{$category->id}}">
                                          <i class="fas fa-edit"></i>
                                   </a>
                                 </span>

                                 <span>
                                   <a class="delete-category"
                                      data-categoryname="{{$category->category_name}}" 
                                      data-categoryid="{{$category->id}}">
                                          <i class="fas fa-trash-alt"></i>
                                   </a>
                                 </span>
                                 </span>

                        <p>{{$category->category_name}}</p>
                       
                     </div>
                   </div>
                   @endforeach

                   </div>                       
                </div>
                {{(!is_null($showLinks)&&$showLinks) ? $categories->links() : ' '}}
                <form action="{{route('search-categories')}}" method="get">  
                     @csrf              
                     <div class="row">                 
                           <div class="form-group col-md-6">
                               <input type="text" class="form-control" id="category_search" name= "category_search" placeholder="Search Category" required>
                         </div>
                         <div class="form-group col-md-6">
                             <button type="submit" class="btn btn-primary">SEARCH</button>
                       </div>
                       </div>
                     </form>
            </div>
		</div>
	</div>
</div>



<div class="modal delete-window" tabindex="-1" role="dialog" id="delete-window">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{route('categories')}}" method="post">
          <div class="modal-body">
            <p id="delete-message"></p>
  
                   @csrf
                   <input type="hidden" name="_method" value="delete" />
                   <input type="hidden" name="category_id" value="" id="category_id" />
         </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
            <button type="submit" class="btn btn-primary">DELETE</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  
  
  
    <div class="modal edit-window" tabindex="-1" role="dialog" id="edit-window">
        <form action="{{route('categories')}}" method="post" >   
      <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title">Edit Category</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>            
             <div class="modal-body">             
                    @csrf 
                         <div class="form-group col-md-6">
                               <label for="edit_unit_name">Category Name</label>
                               <input type="text" class="form-control" id="edit_category_name" name= "category_name" placeholder="Category Name" required>
                         </div>
  
                        
                          <input type="hidden" name="category_id" id="edit_category_id">
                        <input type="hidden" name="_method" value="PUT" />
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
               <button type="submit" class="btn btn-primary">UPDATE</button>
             </div>            
           </div>
         </div>
        </form>
       </div>



@if (Session::has('message'))
<div class="toast" style="position: absolute; z-index:99999; top: 0; right: 0;">
  <div class="toast-header">

    <strong class="mr-auto">Category</strong>

    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
       {{Session::get('message')}}
  </div>
</div>

@endif
 
@endsection







@section('scripts')
   
<script>
      jQuery(document).ready(function(){
         var $deleteCategory = $('.delete-category');
         var $deleteWindow = $('#delete-window');
         var $categoryId = $('#category_id');
         var $deletMessage = $('#delete-message');
         $deleteCategory.on('click',function(element){
            element.preventDefault();
            var category_id = $(this).data('categoryid');
            var categoryName = $(this).data('categoryname');
            $categoryId.val(category_id);
            $deletMessage.text('Are you sure you want to delete this message');
            $deleteWindow.modal('show');
         });        
      });
</script>

<script>
      jQuery(document).ready(function(){
         var $editCategory = $('.edit-category');
       var $editWindow = $('#edit-window');
       var $edit_category_id = $('#edit_category_id');
       var $edit_category_name = $('#edit_category_name');
       $editCategory.on('click',function(element){
          element.preventDefault();
          var edit_category_id = $(this).data('categoryid');
          var edit_category_name = $(this).data('categoryname');

          $edit_category_id.val(edit_category_id);
          $edit_category_name.val(edit_category_name);
          $editWindow.modal('show');
       })
      });
    </script>

@if (Session::has('message'))
<script>
jQuery(document).ready(function($){
var $toast =$('.toast').toast({
   autohide : false
});

$toast.toast('show');
});
</script>
 @endif
 @endsection


