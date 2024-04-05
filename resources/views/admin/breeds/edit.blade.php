@extends('admin.layouts.app')


@section('content')
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Breed</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('breeds.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('breeds.store') }}" id="editBreedForm" name="editBreedForm" method="post">
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="breed">Breed</label>
                                <input type="text" name="breed" id="breed" value="{{ $breed->breed }}" class="form-control" placeholder="Breed">	
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" readonly name="slug" id="slug" value="{{ $breed->slug }}" class="form-control" placeholder="Slug">	
                                <p></p>
                            </div>
                        </div>			
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ ($breed->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ ($breed->status == 0) ? 'selected' : '' }} value="0">Block</option>
                                </select>
                                <p></p>
                            </div>
                        </div>						
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('breeds.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->	
@endsection

@section('customJs')
<script>
    // Form Validation
    $("#editBreedForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("breeds.update", $breed->id) }}',
            type: 'put',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);


                if(response["status"] == true) {

                    window.location.href="{{ route('breeds.index') }}"

                    $("#breed").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");

                    $("#slug").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");

                } else{

                    if (response['notFound'] == true) {
                        window.location.href="{{ route('breeds.index') }}";
                        return false;
                    }

                    var errors = response['errors'];
                    if(errors['breed']) {
                        $("#breed").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['breed']);
                    } else {
                        $("#breed").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }

                    if(errors['slug']) {
                        $("#slug").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['slug']);
                    } else{
                        $("#slug").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }
                }


                

            }, error: function(jqXHR, exception){
                console.log("Something went wrong");
            }
        })
    });


    //makign slug using name input field
    $("#breed").change(function(){
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


   
</script>
@endsection