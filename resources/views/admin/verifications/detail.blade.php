@extends('admin.layouts.app')

@section('content')

<style>
    #user-details {
        position: fixed;
        top: 170px; /* Adjust this value as needed */
        right: 15px; /* Adjust this value as needed */
        z-index: 1000; /* Ensure it appears above other content */
    }

    section{
        background-color: #fff;
    }
</style>

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('verifications.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
        
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
                                        <input type="text" readonly name="full_name" id="full_name" class="form-control" value="{{ $verification->name  }}">
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email">Email Address <span class="required" style="color: red;">*</span></label>
                                        <input type="text" readonly name="email" id="email" class="form-control" value="{{ $verification->email }}">
                                        <p></p>
                                     </div>            
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email">Age <span class="required" style="color: red;">*</span></label>
                                        <input type="number" readonly name="age" id="age" class="form-control" value="{{ $verification->age }}">
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
                                        <input type="text" readonly name="father" id="father" class="form-control" value="{{ $verification->father_spouse }}">
                                        <p></p>
                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="address">Address <span class="required" style="color: red;">*</span></label>
                                        <input type="text" readonly name="address" id="address" class="form-control" value="{{ $verification->address }}">
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
                                        <input type="text" readonly name="city" id="city" class="form-control" value="{{ $verification->city }}">
                                        <p></p>
                                    </div>            
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                    <label for="province">Province <span class="required" style="color: red;">*</span></label>
                                    <input type="text" readonly name="province" id="province" class="form-control" value="{{ $verification->province }}">
                                        <p></p>
                                    </div>            
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                    <label for="zip">Zip Code <span class="required" style="color: red;">*</span></label>
                                        <input type="text" readonly name="zip" id="zip" class="form-control" value="{{ $verification->zip }}">
                                        <p></p>
                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                    <label for="mobile">Mobile No. <span class="required" style="color: red;">*</span></label>
                                        <input type="text" readonly name="mobile" id="mobile" class="form-control" placeholder="Mobile No." value="{{ $verification->mobile }}">
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
                                        <input type="text" readonly name="mobile" id="mobile" class="form-control" placeholder="Mobile No." value="{{ $verification->document_type }}">
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="card mb-3">
                                <div class="card-body">
                                        @php
                                            $verifyImage = getVerificationImage($verification->id);
                                        @endphp

                                        @if (!empty($verifyImage->image))
                                        <a href="{{ asset('uploads/verify/'.$verifyImage->image) }}" target="_blank">
                                            <img class="img-fluid" src="{{ asset('uploads/verify/'.$verifyImage->image) }}">
                                        </a>
                                        @else
                                        <img class="img-fluid" src="{{ asset('admin-assets/img/default-150x150.png') }}">

                                        @endif
                                </div>	                                                                      
                            </div>
                            <div class="mb-3 ml-4">
                                <button id="verifyBtn" class="btn btn-success mr-3"><i class="fa fa-check-circle"></i> Verify</button>
                                <button id="rejectBtn" class="btn btn-danger"><i class="fa fa-ban"></i> Reject</button>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" id="user-details">
                    <div class="sub-title">
                        <h2>User Details</h3>
                    </div>                    
                    <div class="card cart-summery">
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h5"><b>User Name:</b> {{ $verification->user->name }}</div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h5"><b>User Email:</b> {{ $verification->user->email }}</div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <!-- <div class="h5"><b>User Status:</b> {{ $verification->user->status }}</div> -->
                                @if ($verification->user->status== "Unverified")
                                    <div class="h5"><b>User Status:</b><span class="text-danger"> Unverified</span></div>
                                @elseif ($verification->user->status== "In Progress")
                                    <div class="h5"><b>User Status:</b><span class="text-info"> In Progress</span></div>
                                @elseif ($verification->user->status== "Verified")
                                    <div class="h5"><b>User Status:</b><span class="text-success"> Verified</span></div>
                                @else
                                <div class="h5"><b>User Status:</b><span class="text-danger"> Rejected</span></div>
                                @endif
                            </div>                
                        </div>
                    </div>   
                    
                    

                            
                    <!-- CREDIT CARD FORM ENDS HERE -->
                    
                </div>
            </div>
        
    </div>
</section>



@endsection

@section('customJs')
<script>

    // Function to handle the Verify button click
    $('#verifyBtn').click(function() {
        updateUserStatus('Verified');
    });

    // Function to handle the Reject button click
    $('#rejectBtn').click(function() {
        updateUserStatus('Rejected');
    });

    // Function to send AJAX request and update user status
    function updateUserStatus(status) {
        var verificationId = {{ $verification->id }};
        $.ajax({
            url: "{{ route('verifications.updateUserStatus', ['id' => $verification->id]) }}",
            type: 'PUT', 
            data: { status: status },
            success: function(response) {
                // Reload the page or update UI as needed
                location.reload();

                if (status === 'Verified') {
                    alert('User successfully verified!');
                    
                } else if (status === 'Rejected') {
                    
                    alert('User successfully rejected!');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
    
</script>
@endsection