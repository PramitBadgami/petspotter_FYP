@extends('frontend.layouts.app')

@section('content')
<section class="section-1">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <img src="images/carousel-3.jpg" class="d-block w-100" alt=""> -->

                <picture>
                    <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/pet-carousel-3-m.jpg') }}" />
                    <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/pet-carousel-3.jpg') }}" />
                    <img src="{{ asset('front-assets/images/pet-carousel-3.jpg') }}" alt="" />
                </picture>

                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Adopt Pets</h1>
                        <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Adopt Now</a>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                <picture>
                    <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/pet-carousel-1-m.jpg') }}" />
                    <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/pet-carousel-1.jpg') }}" />
                    <img src="{{ asset('front-assets/images/pet-carousel-1.jpg') }}" alt="" />
                </picture>

                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Dog Products</h1>
                        <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="http://127.0.0.1:8000/shop/dog-products">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                

                <picture>
                    <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/pet-carousel-2-m.jpg') }}" />
                    <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/pet-carousel-2.jpg') }}" />
                    <img src="{{ asset('front-assets/images/pet-carousel-2.jpg') }}" alt="" />
                </picture>

                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Cat Products</h1>
                        <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="http://127.0.0.1:8000/shop/cat-products">Shop Now</a>
                    </div>
                </div>
            </div>
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<!-- <section class="section-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                </div>                    
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>                    
            </div>
        </div>
    </div>
</section> -->
<section class="section-3 mt-5">
    <div class="container">
        <div class="section-title">
            <h2>Pet Category</h2>
        </div>           
        <div class="row pb-3">
            @if (getPetCategories()->isNotEmpty())
                @foreach (getPetCategories() as $index => $category)
                    @if ($index < 4)
                    <div class="col-lg-3">
                        <div class="cat-card">
                            <div class="left" style="height: 140px; overflow: hidden;">
                                @if ($category->image != "")
                                <img src="{{ asset('uploads/petcategory/thumb/'.$category->image) }}" alt="" class="img-fluid"  style="object-fit: cover; object-position: center; width: 100%; height: 100%;">
                                @endif
                            </div>
                            <div class="right">
                                <div class="cat-data">
                                    <h2>{{ $category->name }}</h2>
                                    <!-- <p>100 Products</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif

        </div>
    </div>
</section>

<section class="section-4 pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Featured Pets</h2>
        </div>    
        <div class="row pb-3">
            @if ($featuredPets->isNotEmpty())
                @foreach ($featuredPets as $pet)
                @php
                    $petImage = $pet->pet_images->first();
                @endphp
                <div class="col-md-3">
                    <div class="card product-card" style="height: 370px;">
                        <div class="product-image position-relative">
                            <a href="{{ route('frontend.pet',$pet->slug) }}" class="product-img">
                                

                                @if (!empty($petImage->image))
                                    <img class="card-img-top" src="{{ asset('uploads/pet/small/'.$petImage->image) }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px;" >
                                @else
                                    <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                                @endif

                            </a>
                            <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                            
                        </div>                        
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="product.php"><h6><strong>{{ $pet->name }}</strong></h6></a>
                            <div class="price mt-2">
                                <span class="h8">Age: {{ $pet->age }}</span>
                                
                            </div>
                        </div>                        
                    </div>                                               
                </div> 
                @endforeach
            @endif

                        
        </div>
    </div>
</section>


<section class="section-4 pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Latest Pets</h2>
        </div>    
        <div class="row pb-3">
        @if ($latestpets->isNotEmpty())
            @foreach ($latestpets as $pet)
            @php
                $petImage = $pet->pet_images->first();
            @endphp
            <div class="col-md-3">
                <div class="card product-card" style="height: 370px;">
                    <div class="product-image position-relative">
                        <a href="{{ route('frontend.pet',$pet->slug) }}" class="product-img">
                            

                            @if (!empty($petImage->image))
                                <img class="card-img-top" src="{{ asset('uploads/pet/small/'.$petImage->image) }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px;" >
                            @else
                                <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                            @endif
                            
                        </a>
                        <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                        
                    </div>                        
                    <div class="card-body text-center mt-3">
                        <a class="h6 link" href="product.php"><h6><strong>{{ $pet->name }}</strong></h6></a>
                        <div class="price mt-2">
                            <span class="h8">Age: {{ $pet->age }}</span>
                            
                        </div>
                    </div>                        
                </div>                                   
            </div> 
            @endforeach
        @endif
        </div>
    </div>
</section>


<section class="section-4 pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Featured Pet Products</h2>
        </div>    
        <div class="row pb-3">
            @if ($featuredProducts->isNotEmpty())
                @foreach ($featuredProducts as $product)
                @php
                    $productImage = $product->product_images->first();
                @endphp
                <div class="col-md-3">
                    <div class="card product-card" style="height: 430px;">
                        <div class="product-image position-relative">
                            <a href="{{ route("frontend.product", $product->slug) }}" class="product-img">
                                

                                @if (!empty($productImage->image))
                                <img class="card-img-top" src="{{ asset('uploads/product/small/'.$productImage->image) }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 10px;" >
                                @else
                                <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                                @endif

                            </a>
                            <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                            <div class="product-action">
                                <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $product->id }});">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>                            
                            </div>
                        </div>                        
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="product.php">{{ $product->title }}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>Rs.{{ $product->price }}</strong></span>
                                @if($product->compare_price > 0)
                                <span class="h6 text-underline"><del>Rs.{{ $product->compare_price }}</del></span>
                                @endif
                            </div>
                        </div>                        
                    </div>                                               
                </div> 
                @endforeach
            @endif

                        
        </div>
    </div>
</section>





<section class="section-4 pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Latest Produsts</h2>
        </div>    
        <div class="row pb-3">
        @if ($latestproducts->isNotEmpty())
            @foreach ($latestproducts as $product)
            @php
                $productImage = $product->product_images->first();
            @endphp
            <div class="col-md-3">
                <div class="card product-card" style="height: 430px;">
                    <div class="product-image position-relative">
                        <a href="{{ route("frontend.product", $product->slug) }}" class="product-img">
                            

                            @if (!empty($productImage->image))
                            <img class="card-img-top" src="{{ asset('uploads/product/small/'.$productImage->image) }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 10px;">
                            @else
                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}"  style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                            @endif
                        </a>
                        <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                        <div class="product-action">
                            <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $product->id }});">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </a>                            
                        </div>
                    </div>                        
                    <div class="card-body text-center mt-3">
                        <a class="h6 link" href="product.php">{{ $product->title }}</a>
                        <div class="price mt-2">
                            <span class="h5"><strong>Rs.{{ $product->price }}</strong></span>
                            @if($product->compare_price > 0)
                            <span class="h6 text-underline"><del>Rs.{{ $product->compare_price }}</del></span>
                            @endif
                        </div>
                    </div>                        
                </div>                                               
            </div> 
            @endforeach
        @endif
        </div>
    </div>
</section>
@endsection