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
                <li class="breadcrumb-item">Adoption Process</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
        <form id="adoptForm" name="adoptForm" action="" method="post">
        @csrf
        <input type="hidden" name="pet_id" value="{{ $pet->id }}">
            <div class="row">
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Personal Questions</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">
                                
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_1">Q1. Why do you want to adopt this pet ({{$pet->name}})? <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_1" id="question_1" cols="30" rows="3" placeholder="Please tell us why you're interested in adopting this particular pet." class="form-control"></textarea>
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_2">Q2. Are you financially prepared to cover the costs associated with pet ownership, including food, supplies, grooming, training, and medical expenses? <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_2" id="question_2" cols="30" rows="3" placeholder="Please describe your financial readiness to cover pet expenses." class="form-control"></textarea>
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_3">Q3. Have you ever adopted a pet before? (if yes, please describe) <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_3" id="question_3" cols="30" rows="3" placeholder="If yes, please share your past experience with pet adoption." class="form-control"></textarea>
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_4">Q4. Do you currently own any other pets? (if yes, please describe) <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_4" id="question_4" cols="30" rows="3" placeholder="If yes, please provide details about your current pets." class="form-control"></textarea>
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_5">Q5. What is your living situation like? Do you live in a house/apartment/rented place? <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_5" id="question_5" cols="30" rows="3" placeholder="Describe your current living situation..." class="form-control"></textarea>
                                        <p></p>
                                    </div>            
                                </div>
                                
                                <button type="submit" class="btn-dark btn btn-block w-25">Submit</button>
                            </div>
                        </div>
                    </div>    

                </div>
                <div class="col-md-4">
                    <div class="sub-title">
                        <h2>Pet Details</h3>
                    </div>

                        @php
                            $petImage = $pet->pet_images->first();
                        @endphp
                        <a href="{{ route('frontend.pet',$pet->slug) }}" class="product-img">
                        @if (!empty($petImage->image))
                            <img class="card-img-top" src="{{ asset('uploads/pet/large/'.$petImage->image) }}" style="object-fit: contain; object-position: center; width: 100%; height: 300px;" >
                        @else
                            <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                        @endif
                        </a><br><br>
                        <center><h5>Name: <b>{{ $pet->name }}</b></h5>
                    
                        <hr style="width: 50%;">
                        <h5 class="age">Age: <strong>{{ $pet->age }}</strong></h5>
                        <hr style="width: 50%;">
                        <h5 class="age">
                        @if($pet->gender == 'Male')
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gender-male" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gender-female" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8M3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5"/>
                            </svg>
                        @endif
                        {{ $pet->gender }}
                        
                        </h5></center>
                        <br><br>

                        <div class="sub-title">
                            <h2>Form Details</h3>
                        </div> 
                    
                        <div class="alert alert-success" role="alert"  id="user-details">
                            <h5 class="h5 alert-heading"><b>Required details for adoption process</b></h5>
                            
                            <hr>
                            
                            <ul>
                                <li><b>1. </b> Reason for adoption</li>
                                <li><b>2. </b> Financial Question</li>
                                <li><b>3. </b> Any past adoptions</li>
                                <li><b>4. </b> Current pet status</li>
                                <li><b>5. </b> Current living situation</li>
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
        

        $("#adoptForm").submit(function(event) {
            event.preventDefault();
            
            $('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: '{{ route("frontend.processAdopt") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    var errors = response.errors;

                    $('button[type="submit"]').prop('disabled', false);
                    if (response.status == false) {

                        if (errors.question_1) {
                            $("#question_1").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.question_1);
                        } else {
                            $("#question_1").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.question_2) {
                            $("#question_2").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.question_2);
                        } else {
                            $("#question_2").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.question_3) {
                            $("#question_3").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.question_3);
                        } else {
                            $("#question_3").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.question_4) {
                            $("#question_4").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.question_4);
                        } else {
                            $("#question_4").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                        if (errors.question_5) {
                            $("#question_5").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.question_5);
                        } else {
                            $("#question_5").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html("");
                        }

                    } else{
                        window.location.href = '{{ route("frontend.success") }}';
                    }
                }
            });
        });




        
    </script>

@endsection