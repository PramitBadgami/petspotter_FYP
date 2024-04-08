@extends('admin.layouts.app')

@section('content')
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Pet Details</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('pets.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <form action="" method="post" name="petForm" id="petForm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">								
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="title">Name</label>
                                        <input type="text" value="{{ $pet->name }}" name="name" id="name" class="form-control" placeholder="Name">	
                                    <p class="error"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="title">Slug</label>
                                        <input type="text" readonly value="{{ $pet->slug }}" name="slug" id="slug" class="form-control" placeholder="Slug">	
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description">Short Description</label>
                                        <textarea name="short_description" id="short_description" cols="30" rows="10" class="summernote" placeholder="">{{ $pet->short_description }}</textarea>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description">{{ $pet->description }}</textarea>
                                    </div>
                                </div>      
                                                                      
                            </div>
                        </div>	                                                                      
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Media</h2>						
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">    
                                    <br>Drop files here or click to upload.<br><br>                                            
                                </div>
                            </div>
                        </div>	                                                                      
                    </div>
                    <div class="row" id="pet-gallery">
                        @if ($petImages->isNotEmpty())
                            @foreach ($petImages as $image)
                            <div class="col-md-3" id="image-row-{{ $image->id }}">
                                <div class="card">
                                    <input type="hidden" name="image_array[]" value="{{ $image->id }}">
                                    <img src="{{ asset('uploads/pet/small/'.$image->image) }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <a href="javascript:void(0)" onclick="deleteImage({{ $image->id }})" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Pricing</h2>								
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" id="price" class="form-control" placeholder="Price">	
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="compare_price">Compare at Price</label>
                                        <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                        <p class="text-muted mt-3">
                                            To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                        </p>	
                                    </div>
                                </div>                                            
                            </div>
                        </div>	                                                                      
                    </div> -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Related Pets</h2>
                            <div class="mb-3">
                                <select multiple class="related_pet w-100" name="related_pets[]" id="related_pets">
                                    @if (!empty($relatedPets))
                                        @foreach ($relatedPets as $relPet)
                                            <option selected value="{{ $relPet->id }}">{{ $relPet->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Pet Details</h2>								
                            <div class="row">
                                <div class="col-md-6">
                                <label for="gender">Gender</label>
                                    <div class="mb-3">
                                    <select name="gender" id="gender" class="form-control">
                                        <option {{ ($pet->gender == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                        <option {{ ($pet->gender == 'Female') ? 'selected' : '' }} value="Female">Female</option>                                                
                                    </select>
                                    <p class="error"></p>
                                </div>
                                </div>
                                  
                                <div class="col-md-12">
                                    <label for="age">Age</label>
                                    <div class="mb-3">
                                        <input type="number" value="{{ $pet->age }}" min="0" name="age" id="age" class="form-control" placeholder="Age">	
                                        <p class="error"></p>
                                    </div>
                                </div>                                         
                            </div>
                        </div>	                                                                      
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Pet status</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="card">
                        <div class="card-body">	
                            <h2 class="h4  mb-3">Pet category</h2>
                            <div class="mb-3">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select a Category</option>
                                    @if ($petCategories->isNotEmpty())
                                        @foreach ($petCategories as $petCategory)
                                            <option {{ ($pet->category_id == $petCategory->id) ? 'selected' : '' }} value="{{ $petCategory->id }}">{{ $petCategory->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                                <p class="error"></p>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Pet breed</h2>
                            <div class="mb-3">
                                <select name="breed" id="breed" class="form-control">
                                    <option value="">Select a brand</option>    
                                    @if ($breeds->isNotEmpty())
                                        @foreach ($breeds as $breed)
                                        <option {{ ($pet->breed_id == $breed->id) ? 'selected' : '' }} value="{{ $breed->id }}">{{ $breed->breed }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-3">
                        <div class="card-body">	
                            <h2 class="h4 mb-3">Featured pets</h2>
                            <div class="mb-3">
                                <select name="is_featured" id="is_featured" class="form-control">
                                    <option {{ ($pet->is_featured == 'No') ? 'selected' : '' }} value="No">No</option>
                                    <option {{ ($pet->is_featured == 'Yes') ? 'selected' : '' }} value="Yes">Yes</option>                                                
                                </select>
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>                                 
                </div>
            </div>
            
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('pets.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
    </form>

    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customJs')
<script>
    //Recommendations
    $('.related_pet').select2({
        ajax: {
            url: '{{ route("pets.getPets") }}',
            dataType: 'json',
            tags: true,
            multiple: true,
            minimumInputLength: 3,
            processResults: function (data) {
                return {
                    results: data.tags
                };
            }
        }
    }); 


        //To select the slug as the name given to the sub category
        $("#name").change(function(){
            element = $(this);
            $("button[type=submit]").prop('disabled', true);

            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'get',
                data: {title: element.val()},
                dataType: 'json',
                success: function(response){
                    $("button[type=submit]").prop('disabled', false);
                    if(response["status"] == true) {
                        $("#slug").val(response["slug"]);
                    }

                }
            });
        });


        $("#petForm").submit(function(event){
            event.preventDefault();
            var formArray = $(this).serializeArray();
            $("button[type='submit']").prop('disabled',true);

            $.ajax({
                url:'{{ route("pets.update",$pet->id) }}',
                type: 'put',
                data: formArray,
                dataType: 'json',
                success: function(response) {
                    $("button[type='submit']").prop('disabled',false);

                    if(response['status'] == true) {
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                        window.location.href="{{ route('pets.index') }}";
                    } else {
                        var errors = response['errors'];



                        //Displaying the errors if field is submitted empty
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
                        //key="title,slug,etc" and value="The title field is required."
                        $.each(errors, function(key, value){
                            $(`#${key}`).addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(value);
                        });

                    }
                },
                error: function(){
                    console.log("Something Went Wrong!");
                }
            });
        });

        Dropzone.autoDiscover = false;
        //above div of id=image (we used this dropzone there)
        const dropzone = $("#image").dropzone({
            url: "{{ route('pet-images.update') }}",
            maxFiles: 10,
            paramName: 'image',
            params: {'pet_id': '{{ $pet->id }}'},
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                //The image id of the image is stored in the input field 
                //$("#image_id").val(response.image_id);
                //console.log(response)

                var html = `<div class="col-md-3" id="image-row-${response.image_id}"><div class="card">
                    <input type="hidden" name="img_array[]" value="${response.image_id}">
                    <img src="${response.ImagePath}" class="card-img-top" alt="">
                    <div class="card-body">
                        <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                    </div>
                </div></div>`;

                $("#pet-gallery").append(html);
            },
            complete: function(file){
                this.removeFile(file);
            }
        });

        function deleteImage(id) {
            $("#image-row-"+id).remove();
            if(confirm("Are you sure you want to delete image?")){

                $.ajax({
                    url:'{{route("pet-images.destroy")}}',
                    type: 'delete',
                    data:{id:id},
                    success: function(response) {
                        if (response.status== true) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        }

</script>
@endsection
