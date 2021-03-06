@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
             <div class="card-header">
                    {!! (!is_null($product)) ? 'Update Product <span class="product-header-title">'.$product->title.'</span>': 'Add New Product' !!}
             </div>
               <div class="card-body">
               <form action="{{(!is_null($product))? route('update-product') : route('new-product') }}" 
               method="POST" class="row" enctype="multipart/form-data">
                @csrf
                @if (!is_null($product))
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                @endif

                <div class="form-group col-md-12">
                        <label for="product_title">Product Title</label>
                        <input type="text" class="form-control" id="product_title" name= "product_title" placeholder="Product Title" required
                value="{{!is_null($product)? $product->title : ''}}"
                        >
                  </div>

                  <div class="form-group col-md-12">
                        <label for="product_description">Product Description</label>
                        <textarea required placeholder="Product Description" class="form-control" name="product_description" id="product_description" cols="30" rows="10">{{!is_null($product)? $product->description : ''}}
                        </textarea>
                  </div>


                  <div class="form-group col-md-12">
                        <label for="product_category">Product Category</label>
                        <select class="form-control" name="product_category" id="product_category" required>
                         <option>Select a Category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"  {{(!is_null($product)&&($product->category->id === $category->id)) ? 'selected' : ''}}>{{$category->category_name}}</option>
                        @endforeach
                        </select>
                  </div>


                  <div class="form-group col-md-12">
                        <label for="product_unit">Product Unit</label>
                        <select class="form-control" name="product_unit" id="product_unit" required>
                         <option>Select a Unit</option>
                        @foreach ($units as $unit)
                            <option value="{{$unit->id}}"  {{(!is_null($product)&&($product->hasUnit->id === $unit->id)) ? 'selected' : ''}}>{{$unit->formatted()}}</option>
                        @endforeach
                        </select>
                  </div>


                  <div class="form-group col-md-6">
                        <label for="product_price">Product Price</label>
                        <input type="number" step="any" class="form-control" id="product_price" name= "product_price" placeholder="Product Price" required
                value="{{!is_null($product)? $product->price : ''}}"
                        >
                  </div>

                  <div class="form-group col-md-6">
                        <label for="product_discount">Product Discount</label>
                        <input type="number" step="any" class="form-control" id="product_discount" name= "product_discount" placeholder="Product Discount" required
                value="{{!is_null($product)? $product->discount : ''}}"
                        >
                  </div>
                 

                  <div class="form-group col-md-12">
                        <label for="product_total">Product Total</label>
                        <input type="number" step="any" class="form-control" id="product_total" name= "product_total" placeholder="Product Total" required
                value="{{!is_null($product)? $product->total : ''}}"
                        >
                  </div>
                 

                  
                  

                  {{--OPTIONS--}}
                  <div class="form-group col-md-12">

                    <table id="options-table" class="table table-striped">
                      @if (!is_null($product))
                      @if (!is_null($product->JsonOptions()))
                          @foreach ($product->JsonOptions() as $optionName => $options)
                             @foreach ($options as $option)
                             <tr>
                                <td>{{$optionName}}</td>
                                <td>{{$option}}</td>
                                        <td>
                                        <a class="remove-option">
                                            <i class="fas fa-minus-circle"></i>
                                        </a>   
                                      <input type="hidden" name= "{{$optionName}}}}[]" value="{{$option}}">
                                        </td>
                                        </tr>
                             @endforeach
                             <td><input type="hidden" name="options[]" value = "{{$optionName}}"></td>
                          @endforeach
                      @endif
                      @endif                     
                    </table>
                      <a class="btn btn-outline-dark add-option-btn" class="" href="">Add Option</a>
                  </div>
                 

                  

                   {{--/OPTIONS--}}


                   {{--Images--}}
                   <div class="form-group col-md-12">
                     <div class="row">
                        @for ($i = 0; $i < 3; $i++)
                        <div class="col-md-4 col-sm-12 mb-4">
                          
                            <div class="card image-card-upload" >

                                @if (!is_null($product)&&!is_null($product->images)&&count($product->images)>0)
                                @if (!is_null($product->images[$i])&&isset($product->images[$i])&&!empty($product->images[$i]))
                            <a href="" class="remove-image-upload" data-imageid="{{$product->images[$i]->id}}" data-removeimg="removeimg-{{$i}}" data-fileid="image-{{$i}}"><i class="fas fa-minus-circle"></i></a>
                                @else
                                <a href="" class="remove-image-upload" style="display:none;"><i class="fas fa-minus-circle"></i></a>
                                @endif
                                @endif

                              
                                <a href="#" class="activate-image-upload"  data-fileid="image-{{$i}}" id="removeimg-{{$i}}">

                                
                                @if (!is_null($product)&&!is_null($product->images)&&count($product->images)>0)
                                @if (!is_null($product->images[$i])&&isset($product->images[$i])&&!empty($product->images[$i]))
                                <img id="{{'iimage-' . $i}}" src="{{asset($product->images[$i]->url)}}" class="card-image-top">
                                @endif
                                @endif
                                <div class="card-body" style="...">
                                    @if (!is_null($product)&&!is_null($product->images)&&count($product->images)>0)
                                    @if (!is_null($product->images[$i])&&isset($product->images[$i])&&!empty($product->images[$i]))
                                    <i style="display:none;" class="fas fa-image"></i>
                                    @else
                                    <i class="fas fa-image"></i>
                                    @endif
                                    @else
                                    <i class="fas fa-image"></i>
                                    @endif
                                   
                                </div>
                              </a>


                              @if (!is_null($product)&&!is_null($product->images)&&count($product->images)>0)
                                    @if (!is_null($product->images[$i])&&isset($product->images[$i])&&!empty($product->images[$i]))
                                    <input name="product_images[]" type="file" class="form-control-file image-file-upload" value="" id="image-{{$i}}" value="{{asset($product->images[$i]->url)}}">
                                    @else
                                    <input name="product_images[]" type="file" class="form-control-file image-file-upload" value="" id="image-{{$i}}">
                                    @endif
                                    @else
                                    <input name="product_images[]" type="file" class="form-control-file image-file-upload" value="" id="image-{{$i}}">
                                    @endif


                              
                              </div>
                            
                        </div>
                        @endfor
                     </div>
                   </div>
                   {{--/Images--}}


                   <div class="form-group col-md-6 offset-md-3">
                      <button type="submit" class="btn btn-primary btn-block">SAVE</button>
                    </div>

            </form>
         
               </div>
            </div>
        </div>
    </div>
</div>    
    






       


       <div class="modal option-window" tabindex="-1" role="dialog" id="option-window">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Option</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>            
                      <div class="modal-body row">              
                                  <div class="form-group col-md-6">
                                        <label for="option_name">Option Name</label>
                                        <input type="text" class="form-control" id="option_name" name= "option_name" placeholder="Option Name" required>
                                  </div>  
                                  <div class="form-group col-md-6">
                                      <label for="option_value">Option</label>
                                      <input type="text" class="form-control" id="option_value" name= "option_value" placeholder="Option Value" required>
                                </div>  
                                 
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-primary add-option-button">ADD OPTION</button>
                      </div>            
                   </div>
                  </div>
          </div>



          <div class="modal image-window" tabindex="-1" role="dialog" id="image-window">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Delete Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>            
                      <div class="modal-body row">              
                                  
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                        <a href="#" class="delete-image-btn btn btn-primary">DEKETE IMAGE</a>
                      </div>            
                   </div>
                  </div>
          </div>






 
          

@endsection



@section('scripts')

    <script>
    var optionNameList = [];
    </script>


    <script>

    var imageDelete = '{{route('delete-image')}}';

    </script>

@if (!is_null($product))
@if (!is_null($product->JsonOptions()))
    @foreach ($product->JsonOptions() as $optionName => $options)
      <script>optionNameList.push('{{$optionName}}');</script>
    @endforeach
@endif
@endif 


    <script>
    $(document).ready(function(){

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      console.log(optionNameList);
       var $optionwidow = $('#option-window');
       var $imageWindow = $('.image-window');
       var $addOptionBtn = $('.add-option-btn');
       var $optionsTable = $('#options-table');
       var optionNamesRow = ' ';
       var $activateImageUpload = $('.activate-image-upload');




       $addOptionBtn.on('click',function(element){
        element.preventDefault();
        $optionwidow.modal('show');
       });      


       
       $(document).on('click','.remove-option',function(element){
         element.preventDefault();
         $(this).parent().parent().remove();
       });

       $(document).on('click','.add-option-button',function(element){
         element.preventDefault();
         var $optionName = $('#option_name');
         if($optionName.val() === ''){
             alert('option name is required');
             return false;
         }
         var $optionValue = $('#option_value');
         if($optionValue.val() === ''){
             alert('option value is required');
             return false;
         }
        
         
         if(!(optionNameList.includes($optionName.val()))){
         optionNameList.push($optionName.val());
         optionNamesRow = '<td><input type="hidden" name="options[]" value = '+$optionName.val()+'></td>' ;
         }
        

         var optionRow = `<tr>
            <td>
                `+$optionName.val()+`
            </td>
            <td>
                    `+$optionValue.val()+`
                </td>
                <td>
                <a class="remove-option">
                    <i class="fas fa-minus-circle"></i>
                </a>   
                <input type="hidden" name= "`+$optionName.val()+`[]" value="`+$optionValue.val()+`">
                </td>
                </tr>`;


        $optionsTable.append(optionRow);
        $optionsTable.append(optionNamesRow);
        $('#option_value').val('');
       });

        function readURL(input , imageID){
          if(input.files&&input.files[0]){
            var reader = new FileReader();
            reader.onload = function(element){
              $('#'+imageID).attr('src',element.target.result);
              //console.log(element.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }
        
        
        function resetFileUpload(fileUploadID , imageID , $eI , $eD){
             $('#'+imageID).attr('src' , '');
             if($eD !=null){
               $eD.fadeOut();
             }
             $eI.fadeIn();
             $eD.fadeOut();
             $('#'+fileUploadID).val('');
             //document.getElementById(fileUploadID).value = '';
        }


        $activateImageUpload.on('click',function(element){
         element.preventDefault();
         var fileUploadID = $(this).data('fileid');
         var me = $(this);
         $('#'+fileUploadID).trigger('click');
         var imagetag = '<img id="i'+fileUploadID+'" src="" class="card-image-top">';
         $(this).append(imagetag);
         $('#'+fileUploadID).on('change' , function(element){
          readURL(this , 'i'+fileUploadID);
          me.find('i').fadeOut();
          var $removeThisImage =  me.parent().find('.remove-image-upload');
          $removeThisImage.fadeIn();
          $removeThisImage.on('click' , function(element){
            element.preventDefault();
            resetFileUpload(fileUploadID , 'i'+fileUploadID , me.find('i') , $removeThisImage );
          });
         });


        // alert('clicked');
        //console.log(fileUploadID);
       });

       $('.remove-image-upload').on('click',function(element){
         element.preventDefault();
         
         var me = $(this);
         var imageID = me.data('imageid');
         var removeID = $(this).data('removeimg');
         var fileUploadID = $(this).data('fileid');
         var $removeThisImage =  me.parent().find('.remove-image-upload');
         $('.delete-image-btn').data('ed' , $removeThisImage);
         $('.delete-image-btn').data('fileid' , fileUploadID);
         $('.delete-image-btn').data('removeimg' , removeID);
         $('.delete-image-btn').data('imageid', imageID);
         $imageWindow.modal('show');
         
       });


       $(document).on('click','.delete-image-btn' , function(element){
         element.preventDefault();
         var imageID= $(this).data('imageid');
         var removeID = $(this).data('removeimg');
         var fileUploadID = $(this).data('fileid');
         var ed = $(this).data('ed');
         resetFileUpload(fileUploadID , 'i'+fileUploadID , $('#'+removeID).find('i') , null);
         $.ajax({
           url : imageDelete,
           data :{
            image_id : imageID,
           },
           dataType : 'json',
           method : 'post'
         });
         $imageWindow.modal('show');
       });
    });
    </script>
 
 

@endsection