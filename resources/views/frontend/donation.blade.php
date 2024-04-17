@extends('frontend.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.home') }}">Home</a></li>
                <!-- <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li> -->
                <li class="breadcrumb-item">Donations</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
 
                <form id="donationForm" name="donationForm" action="{{ route('esewa') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="sub-title">
                                <h2>Donation Details</h2>
                            </div>
                            <div class="card shadow-lg border-0">
                                <div class="card-body checkout-form">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name">Name <span class="required" style="color: red;">*</span></label>
                                                <input required type="text" name="name" id="name" class="form-control" placeholder="Full Name">
                                                <p></p>
                                            </div>            
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="email">Email Address <span class="required" style="color: red;">*</span></label>
                                                <input required type="text" name="email" id="email" class="form-control" placeholder="Email Address">
                                                <p></p>
                                            </div>            
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="phone">Phone Number <span class="required" style="color: red;">*</span></label>
                                                <input required type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number">
                                                <p></p>
                                            </div>            
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="amount">Amount <span class="required" style="color: red;">*</span></label>
                                                <input required type="number" name="amount" id="amount" class="form-control" placeholder="Amount">
                                                <p></p>
                                            </div> 
                                                    
                                        </div>
                                        <button type="submit" class="btn-dark btn btn-block w-29">Pay With Esewa</button>
                                        <!-- <input type="submit" value="Pay With Esewa"> -->

                                    </div>
                                </div>
                            </div>    
                        

                        </div>
                        <div class="col-md-5">
                        <div class="sub-title">
                            <h2>Together we can</h2>
                        </div>                    
                            <p>PetSpotter saves animals every day from mistreatment, abandonment, disease, and harm. Whether it’s a farm animal or a community dog who needs life-saving medical care, without your support, none of this would be possible. In addition to actively promoting animal welfare and working with the government to improve animal welfare in Nepal, we rescue and provide medication for community animals in need.</p>

                        <div class="d-flex gap-2">
                           <img src="{{ asset('front-assets/images/donation1.jpg') }}" style= "width: 50%;">
                           <img src="{{ asset('front-assets/images/donation2.jpg') }}" style= "width: 50%;">
                        </div>
                        
                                                
                        </div>
                
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection