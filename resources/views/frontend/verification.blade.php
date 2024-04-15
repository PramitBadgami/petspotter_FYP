@extends('frontend.layouts.app')

@section('content')
<style>
    /* #user-details {
        position: fixed;
        top: calc(100vh - 280px); 
        right: 25px;
        z-index: 1000; 
        max-width: 450px;
    } */


</style>

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.home') }}">Home</a></li>
                <!-- <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li> -->
                <li class="breadcrumb-item">Verification</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
        <form id="verifyForm" name="verifyForm" action="" method="post">
            <div class="row">
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Personal Details</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="full_name">Full Name <span class="required" style="color: red;">*</span></label>
                                        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full Name">
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email">Email Address <span class="required" style="color: red;">*</span></label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email Address">
                                        <p></p>
                                     </div>            
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email">Age <span class="required" style="color: red;">*</span></label>
                                        <input type="number" name="age" id="age" class="form-control" placeholder="Age">
                                        <p></p>
                                    </div> 
                                              
                                </div>

                                <!-- <div class="col-md-12">
                                    <div class="mb-3">
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select a Country</option>
                                            <option value="1">India</option>
                                            <option value="2">UK</option>
                                        </select>
                                    </div>            
                                </div> -->

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="father">Father/Spouse <span class="required" style="color: red;">*</span></label>
                                        <input type="text" name="father" id="father" class="form-control" placeholder="Father/Spouse">
                                        <p></p>
                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="address">Address <span class="required" style="color: red;">*</span></label>
                                        <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control"></textarea>
                                        <p></p>
                                    </div>            
                                </div>

                                <!-- <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="appartment" id="appartment" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)">
                                    </div>            
                                </div> -->

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="city">City <span class="required" style="color: red;">*</span></label>
                                        <input type="text" name="city" id="city" class="form-control" placeholder="City">
                                        <p></p>
                                    </div>            
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                    <label for="province">Province <span class="required" style="color: red;">*</span></label>
                                        <select name="province" id="province" class="form-control">
                                            <option value="">Select a Province</option>
                                            <option value="koshi">Koshi</option>
                                            <option value="madhesh">Madhesh</option>
                                            <option value="bagmati">Bagmati</option>
                                            <option value="gandaki">Gandaki</option>
                                            <option value="lumbini">Lumbini</option>
                                            <option value="karnali">Karnali</option>
                                            <option value="sudurpashchim">Sudurpashchim</option>
                                        </select>
                                        <p></p>
                                    </div>            
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                    <label for="zip">Zip Code <span class="required" style="color: red;">*</span></label>
                                        <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip Code">
                                        <p></p>
                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                    <label for="mobile">Mobile No. <span class="required" style="color: red;">*</span></label>
                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No.">
                                        <p></p>
                                    </div>            
                                </div>
                                

                                <!-- <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control"></textarea>
                                    </div>            
                                </div> -->

                            </div>
                        </div>
                    </div>    
                    <div class="sub-title mt-5">
                        <h2>Document Details</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="document">Document Type <span class="required" style="color: red;">*</span></label>
                                        <select name="document" id="document" class="form-control">
                                            <option value="">Select Document Type</option>
                                            <option value="citizenship">Citizenship</option>
                                            <option value="passport">Passport</option>
                                            <option value="license">License</option>
                                        </select>
                                        <p></p>
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
                            <div class="row" id="document-gallery">

                            </div>
                            <button type="submit" class="btn-dark btn btn-block w-25">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sub-title">
                        <h2>Verification Details</h3>
                    </div>                    
                    
                        <div class="alert alert-primary" role="alert"  id="user-details">
                            <h5 class="h5 alert-heading"><b>Required document/personal details for verification</b></h5>
                            
                            <hr>
                            
                            <ul>
                                <li><b>1. </b> Copy of citizenship</li>
                                <li><b>2. </b> Address</li>
                                <li><b>3. </b> Email Address</li>
                                <li><b>4. </b> Mobile Number</li>
                            </ul>
                        </div>
                       
                    
                                            
                    </div>

                            
                    <!-- CREDIT CARD FORM ENDS HERE -->
                    
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
    <script>
        

        $("#verifyForm").submit(function(event) {
            event.preventDefault();
            
            $('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: '{{ route("frontend.processVerify") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    var errors = response.errors;

                    if (response.status == false) {

                        if (errors.full_name) {
                            $("#full_name").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.full_name);
                        } else {
                            $("#full_name").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.email) {
                            $("#email").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.email);
                        } else {
                            $("#email").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.age) {
                            $("#age").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.age);
                        } else {
                            $("#age").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.father) {
                            $("#father").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.father);
                        } else {
                            $("#father").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.address) {
                            $("#address").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.address);
                        } else {
                            $("#address").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.province) {
                            $("#province").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.province);
                        } else {
                            $("#province").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.city) {
                            $("#city").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.city);
                        } else {
                            $("#city").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.zip) {
                            $("#zip").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.zip);
                        } else {
                            $("#zip").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.mobile) {
                            $("#mobile").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.mobile);
                        } else {
                            $("#mobile").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.document) {
                            $("#document").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.document);
                        } else {
                            $("#document").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }
                    } else{
                        window.location.href = '{{ route("frontend.adoption") }}';
                    }
                }
            });
        });




        Dropzone.autoDiscover = false;
        //above div of id=image (we used this dropzone there)
        const dropzone = $("#image").dropzone({
            url: "{{ route('temp-product-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                //The image id of the image is stored in the input field 
                //$("#image_id").val(response.image_id);
                //console.log(response)

                var html = `<div class="col-md-3" id="image-row-${response.image_id}"><div class="card">
                    <input type="hidden" name="image_array[]" value="${response.image_id}">
                    <img src="${response.ImagePath}" class="card-img-top" alt="">
                    <div class="card-body">
                        <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                    </div>
                </div></div>`;

                $("#document-gallery").append(html);
            },
            complete: function(file){
                this.removeFile(file);
            }
        });

        function deleteImage(id) {
            $("#image-row-"+id).remove();
        }
    </script>

@endsection