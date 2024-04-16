@extends('frontend.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.adoption') }}">Adoption</a></li>
                <li class="breadcrumb-item">{{ $pet->name }}</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-7 pt-3 mb-3">
    <div class="container">
        <div class="row ">
        <div class="col-md-7">
                <div class="bg-light ">
                    <center><h1>Name: {{ $pet->name }}</h1></center>
                    
                    <hr>
                    <center><h2 class="age mb-4">Age: {{ $pet->age }}</h2></center>
                    <hr>
                    <center><h5 class="age mb-4">
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
                    <hr>
                    {!! $pet->short_description !!}
                    
                    @if (Auth::check())
                        @if ($user->status == 'Unverified')
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Hello Adopters!!</strong> You need to verify before adopting a pet.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                            <a href="{{ route('frontend.verification') }}" class="btn btn-dark"><i class="fa fa-check-circle"></i> &nbsp;VERIFY</a>
                        @elseif ($user->status == 'In Progress')
                        <div class="alert alert-primary" role="alert">
                            <center>Your verification form is currently being reviewed.</center>
                        </div>
                        
                        @elseif ($user->status == 'Verified')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                You are now verified, you can adopt any pet.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                            <a href="{{ route('frontend.adopt', ['slug' => $pet->slug]) }}" class="btn btn-dark"><i class="fa fa-check-circle"></i> &nbsp;Adopt</a>
                        
                        @else
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Your verification form was rejected for some reason. Please check in all the details before submitting the form.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                            <a href="{{ route('frontend.verification') }}" class="btn btn-dark"><i class="fa fa-check-circle"></i> &nbsp;VERIFY</a>
                        @endif
                    @else
                    <a href="{{ route('frontend.verification') }}" class="btn btn-dark"><i class="fa fa-check-circle"></i> &nbsp;VERIFY</a>

                    @endif
                    
                </div>
            </div>
            <div class="col-md-5 right">
                <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner bg-light">
                        
                    @if($pet->pet_images)
                        @foreach($pet->pet_images as $key => $petImage)
                        <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}">
                            <img class="w-100 h-100" src="{{ asset('uploads/pet/large/'.$petImage->image) }}" alt="Image">
                        </div>
                        @endforeach
                    @endif
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>
            

            <div class="col-md-12 mt-5">
                <div class="bg-light">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            {!! $pet->description !!}
                        </div>
                        <!-- <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</p>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab"> -->
                        
                        </div>
                    </div>
                </div>
            </div> 
        </div>           
    </div>
</section>

@if(!empty($relatedPets))
<section class="pt-5 section-8">
    <div class="container">
        <div class="section-title">
            <h2>Recommended Similar Pets</h2>
        </div> 
        <div class="col-md-12">
            <div id="related-products" class="carousel">
                @foreach($relatedPets as $relPets)
                @php
                    $petImage = $relPets->pet_images->first();
                @endphp
                <div class="card product-card">
                    <div class="product-image position-relative">
                        <a href="{{ route('frontend.pet',$relPets->slug) }}" class="product-img">
                            <!-- <img class="card-img-top" src="images/product-1.jpg" alt=""> -->
                            @if (!empty($petImage->image))
                                <img class="card-img-top" src="{{ asset('uploads/pet/small/'.$petImage->image) }}" style="object-fit: cover; object-position: center; width: 100%; height: 260px;" >
                            @else
                                <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                            @endif
                        </a>

                        <a onclick="addToFavouriteList({{ $relPets->id }})" title="Add to favourites list" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>
                        <!-- <div class="product-action">
                            <a class="btn btn-dark" href="{{ route('frontend.verification') }}">
                                <i class="fa fa-check-circle"></i> Verify
                            </a>
                        </div> -->
                    </div>                        
                    <div class="card-body text-center mt-3">
                        <a class="h6 link" href="{{ route('frontend.pet',$relPets->slug) }}"><b>{{ $relPets->name }}</b></a>
                        <div class="price mt-2">
                            <!-- <span class="h5"><strong>{{ $relPets->age }}</strong></span> -->
                            <span class="h8">Age: {{ $relPets->age }}</span>
                            <span class="h8">- {{ $relPets->gender }}</span>
                        </div>
                    </div>                        
                </div> 
                @endforeach

            </div>
        </div>
    </div>
</section>
@endif

@endsection