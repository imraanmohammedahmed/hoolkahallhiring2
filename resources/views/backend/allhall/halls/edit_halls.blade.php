@extends('admin.admin_dashboard')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
			 
				<div class="container">
					<div class="main-body">
						<div class="row">




<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Manage Hall</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false" tabindex="-1">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Hall Number</div>
                    </div>
                </a>
            </li>
            
        </ul>
        <div class="tab-content py-3">
            <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
              
                <div class="col-xl-12 mx-auto">
						
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Update Hall </h5>

    <form class="row g-3" action="{{ route('update.hall',$editData->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="col-md-4">
            <label for="input1" class="form-label">Hall Type Name </label>
            <input type="text" name="halltype_id" class="form-control" id="input1" value="{{ $editData['type']['name'] }}" >
        </div>
        <div class="col-md-4">
            <label for="input2" class="form-label">Total Guest</label>
            <input type="text" name="total_guest" class="form-control" id="input2"  value="{{ $editData->total_guest }}">
        </div>


        <div class="col-md-6">
            <label for="input3" class="form-label">Main Image </label>
            <input type="file" name="image" class="form-control" id="image"  >

            <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/hallimg/multi_img/'.$editData->multi_img) : url('upload/no_image.jpg') }}" 
            alt="Admin" class="bg-primary" width="60"> 
        </div>




        <div class="col-md-6">
            <label for="input4" class="form-label">Gallery Image </label>
            <input type="file" name="multi_img[]" class="form-control" multiple id="multiImg" accept="image/jpeg, image/jpg, image/gif, image/png" >

            @foreach ($multiimgs as $item)

            <img src="{{ (!empty($item->multi_img)) ? url('upload/hallimg/multi_img/'.$item->multi_img) : url('upload/no_image.jpg') }}" alt="Admin" class="bg-primary" width="60"> 

              <a href="{{ route('multi.image.delete',$item->id) }}"><i class="lni lni-circle-minus"></i> </a>  

            @endforeach


            <div class="row" id="preview_img"></div>
        </div>


        <div class="col-md-3">
            <label for="input1" class="form-label"> Price  </label>
            <input type="text" name="price" class="form-control" id="input1" value="{{ $editData->price }}" >
        </div>

        <div class="col-md-3">
            <label for="input2" class="form-label">Size </label>
            <input type="text" name="size" class="form-control" id="input2"  value="{{ $editData->size }}">
        </div>

        <div class="col-md-3">
            <label for="input2" class="form-label">Discount ( % )</label>
            <input type="text" name="discount" class="form-control" id="input2"  value="{{ $editData->discount }}">
        </div>

        <div class="col-md-3">
            <label for="input2" class="form-label">Hall Capacity </label>
            <input type="text" name="hall_capacity" class="form-control" id="input2" value="{{ $editData->hall_capacity }}">
        </div>
  
        <div class="col-md-12">
            <label for="input11" class="form-label">Short Description </label>
            <textarea name="short_desc" class="form-control" id="input11" placeholder="" rows="3">{{ $editData->short_desc }}</textarea>
        </div>

        <div class="col-md-12">
            <label for="input11" class="form-label"> Description </label>
            <textarea name="description" class="form-control" id="myeditorinstance" >{!! $editData->description !!}</textarea>
        </div>




        <div class="row mt-2">
            <div class="col-md-12 mb-3">
               @forelse ($basic_facility as $item)
               <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                  <div class="row add_item">
                     <div class="col-md-8">
                        <label for="facility_name" class="form-label"> Hall Facilities </label>
                        <select name="facility_name[]" id="facility_name" class="form-control">
                              <option value="">Select Facility</option>
                              <option value="Complimentary Breakfast" {{$item->facility_name == 'Complimentary Breakfast'?'selected':''}}>Complimentary Breakfast</option>
             <option value="32/42 inch LED TV"  {{$item->facility_name == 'Complimentary Breakfast'?'selected':''}}> 32/42 inch LED TV</option>
           
            <option value="Smoke alarms"  {{$item->facility_name == 'Smoke alarms'?'selected':''}}>Smoke alarms</option>
           
            <option value="Minibar" {{$item->facility_name == 'Complimentary Breakfast'?'selected':''}}> Minibar</option>
           
            <option value="Work Desk"  {{$item->facility_name == 'Work Desk'?'selected':''}}>Work Desk</option>
           
            <option value="Free Wi-Fi" {{$item->facility_name == 'Free Wi-Fi'?'selected':''}}>Free Wi-Fi</option>
           
            <option value="Safety box" {{$item->facility_name == 'Safety box'?'selected':''}} >Safety box</option>
           
            <option value="Rain Shower" {{$item->facility_name == 'Rain Shower'?'selected':''}} >Rain Shower</option>
           
            <option value="Slippers" {{$item->facility_name == 'Slippers'?'selected':''}} >Slippers</option>
           
            <option value="Hair dryer" {{$item->facility_name == 'Hair dryer'?'selected':''}} >Hair dryer</option>
           
            <option value="Wake-up service"  {{$item->facility_name == 'Wake-up service'?'selected':''}}>Wake-up service</option>
           
            <option value="Laundry & Dry Cleaning" {{$item->facility_name == 'Laundry & Dry Cleaning'?'selected':''}} >Laundry & Dry Cleaning</option>
            
            <option value="Electronic door lock"  {{$item->facility_name == 'Electronic door lock'?'selected':''}}>Electronic door lock</option> 
                        </select>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group" style="padding-top: 30px;">
                              <a class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></a>
                              <span class="btn btn-danger btn-sm removeeventmore"><i class="lni lni-circle-minus"></i></span>
                        </div>
                     </div>
                  </div>
               </div>
           
               @empty
           
                    <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                        <div class="row add_item">
                            <div class="col-md-6">
                                <label for="basic_facility_name" class="form-label">Room Facilities </label>
   <select name="facility_name[]" id="basic_facility_name" class="form-control">
            <option value="">Select Facility</option>
            <option value="Complimentary Breakfast">Complimentary Breakfast</option>
            <option value="32/42 inch LED TV" > 32/42 inch LED TV</option>
            <option value="Smoke alarms" >Smoke alarms</option>
            <option value="Minibar"> Minibar</option>
            <option value="Work Desk" >Work Desk</option>
            <option value="Free Wi-Fi">Free Wi-Fi</option>
            <option value="Safety box" >Safety box</option>
            <option value="Rain Shower" >Rain Shower</option>
            <option value="Slippers" >Slippers</option>
            <option value="Hair dryer" >Hair dryer</option>
            <option value="Wake-up service" >Wake-up service</option>
            <option value="Laundry & Dry Cleaning" >Laundry & Dry Cleaning</option>
            <option value="Electronic door lock" >Electronic door lock</option> 
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="padding-top: 30px;">
                    <a class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></a>
           
                   <span class="btn btn-danger removeeventmore"><i class="lni lni-circle-minus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
           
               @endforelse
           
           
           
                                </div> 
                             </div>
                             <br>
           

 

 
        <div class="col-md-12">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" class="btn btn-primary px-4">Save Changes</button> 
            </div>
        </div>
    </form>
                        </div>
                    </div>
 
                </div>





            </div>
             {{-- // End primaryhome --}}



<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                 <div class="card">
                    <div class="card-body">
    <a class="card-title btn btn-primary float-right" onclick="addHallNo()" id="addHallNo" >
                            <i class="lni lni-plus">Add New</i>
    </a>

    <div class="hallnoHide" id="hallnoHide">
    <form action="{{ route('store.hall.no',$editData->id) }}" method="post">
                @csrf

                <input type="hidden" name="hall_type_id" value="{{ $editData->halltype_id }}" >
            <div class="row">
                <div class="col-md-4">
                    <label for="input2" class="form-label">Hall No </label>
                    <input type="text" name="hall_no" class="form-control" id="input2" >
                </div>
        
                <div class="col-md-4">
                    <label for="input7" class="form-label">Status </label>
                    <select name="status" id="input7" class="form-select">
                        <option selected="name">Select Status...</option>
                        <option value="Active">Active </option>
                        <option value="Inactive">Inactive  </option>
                       
                    </select>  
                </div>

                <div class="col-md-4">
                    
                    <button type="submit" class="btn btn-success" style="margin-top: 28px;">Save</button>
                    
                </div> 
            </div> 
            </form> 
        </div>


        <table class="table mb-0 table-striped" id="roomview">
            <thead>
                <tr>
                    <th scope="col">Hall Number</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th> 
                </tr>
            </thead>
            <tbody>
          
            @foreach ($allhallNo as $item) 

               
                <tr> 
                    <td>{{ $item->hall_no }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                    <a href="{{ route('edit.hallno',$item->id) }}" class="btn btn-warning px-3 radius-30"> Edit</a>
                    <a href="{{ route('delete.hallno',$item->id) }}" class="btn btn-danger px-3 radius-30" id="delete"> Delete</a> 

                    </td>
                </tr>

            @endforeach
                
            </tbody>
        </table>









                    </div>
                    </div> 



            </div>  
            {{-- // end PrimaryProfile --}}
            



        </div>
    </div>
</div>





						 
 
						</div>
					</div>
				</div>
 </div>

 
        <script type="text/javascript">

        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

        </script>   
        
        
        <!--------===Show MultiImage ========------->
<script>
    $(document).ready(function() {
    $('#multiImg').on('change', function() {
        var previewImg = $('#preview_img');

        if (window.File && window.FileReader && window.FileList && window.Blob) {
            var data = $(this)[0].files;

            $.each(data, function(index, file) {
                if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                    var fRead = new FileReader();
                    fRead.onload = (function(file) {
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100).height(80);
                            previewImg.append(img);
                        };
                    })(file);
                    fRead.readAsDataURL(file);
                }
            });
        } else {
            alert("Your browser doesn't support File API!");
        }
    });
});

 </script>


<!--========== Start of add Basic Plan Facilities ==============-->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
       <div class="basic_facility_section_remove" id="basic_facility_section_remove">
          <div class="container mt-2">
             <div class="row">
                <div class="form-group col-md-6">
                   <label for="basic_facility_name">Room Facilities</label>
                   <select name="facility_name[]" id="basic_facility_name" class="form-control">
                         <option value="">Select Facility</option>
  <option value="Complimentary Breakfast">Complimentary Breakfast</option>
  <option value="32/42 inch LED TV" > 32/42 inch LED TV</option>
  <option value="Smoke alarms" >Smoke alarms</option>
  <option value="Minibar"> Minibar</option>
  <option value="Work Desk" >Work Desk</option>
  <option value="Free Wi-Fi">Free Wi-Fi</option>
  <option value="Safety box" >Safety box</option>
  <option value="Rain Shower" >Rain Shower</option>
  <option value="Slippers" >Slippers</option>
  <option value="Hair dryer" >Hair dryer</option>
  <option value="Wake-up service" >Wake-up service</option>
  <option value="Laundry & Dry Cleaning" >Laundry & Dry Cleaning</option>
  <option value="Electronic door lock" >Electronic door lock</option> 
                   </select>
                </div>
                <div class="form-group col-md-6" style="padding-top: 20px">
                   <span class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></span>
                   <span class="btn btn-danger removeeventmore"><i class="lni lni-circle-minus"></i></span>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 
 <script type="text/javascript">
    $(document).ready(function(){
       var counter = 0;
       $(document).on("click",".addeventmore",function(){
             var whole_extra_item_add = $("#whole_extra_item_add").html();
             $(this).closest(".add_item").append(whole_extra_item_add);
             counter++;
       });
       $(document).on("click",".removeeventmore",function(event){
             $(this).closest("#basic_facility_section_remove").remove();
             counter -= 1
       });
    });
 </script>
 <!--========== End of Basic Plan Facilities ==============-->

  <!--========== Start Hall Number Add ==============-->
    <script>

        $('#hallnoHide').hide();
        $('#hallview').show();

        function addHallNo(){
            $('#hallnoHide').show();
            $('#hallview').hide();
            $('#addHallNo').hide();
        }

    </script>

   <!--========== End Hall Number Add ==============-->


@endsection