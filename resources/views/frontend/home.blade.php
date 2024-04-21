@extends('frontend.layouts.app')

@section('content')
<style>
.rotate-90 {
    transform: rotate(90deg);
    position: fixed;
    top: calc(50% - 24px); /* Adjust the top position as needed */
    right: 1274px; /* Adjust the right position as needed */
    z-index: 999; /* Ensure it's above other elements */
}

.ban_sec {
  width: 100%;
}
.ban_img {
  width: 100%;
  position: relative;
}
.ban_img img {
  width: 100%;
}
.ban_text {
  position: absolute;
  top: 50%;
  left: 6%;
  -ms-transform: translateY(-50%);
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
}
.ban_text strong {
  font: 800 62.22px/70px "Montserrat", sans-serif;
  color: #fff;
  text-transform: uppercase;
}
.ban_text strong span {
  font: 400 44.44px/52px "Montserrat", sans-serif;
  letter-spacing: 3px;
}
.ban_text p {
  font: 400 25px/30px "Montserrat", sans-serif;
  color: #fff;
  margin: 7px 0 25px;
}
.ban_text a {
  display: inline-block;
  font: 800 19.39px/24px "Montserrat", sans-serif;
  background: #282828;
  border-radius: 26px;
  color: #fff;
  padding: 12px 28px;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  text-decoration:none;
}
.ban_text a:hover {
  background: #F7CA0D;
}

@media (min-width: 1200px) and (max-width: 1399px) {
  .ban_text p {
    font-size: 21px;
  }
}

@media (min-width: 992px) and (max-width: 1199px) {
  .ban_text p {
    font-size: 17px;
  }
  .ban_text strong {
    font-size: 50px;
    line-height: 60px;
  }
  .ban_text strong span {
    font-size: 37px;
  }
  .ban_text a {
    font-size: 16px;
    line-height: 19px;
  }
}

@media only screen and (max-width: 991px) {
  .ban_text strong {
    font-size: 35px;
    line-height: 40px;
  }
  .ban_text strong span {
    font-size: 28px;
    line-height: 35px;
    letter-spacing: 2px;
  }
  .ban_text p {
    font-size: 14px;
    line-height: 20px;
  }
  .ban_text a {
    font-size: 13.39px;
    line-height: 15px;
  }
}
@media only screen and (max-width: 767px) {
  .ban_img img {
    min-height: 290px;
    object-fit: cover;
  }
}
@media only screen and (max-width: 575px) {
  .ban_text strong {
    background: rgba(0, 0, 0, 0.8);
    padding: 10px;
    width: 100%;
    display: block;
  }
}
@media only screen and (max-width: 480px) {
  .ban_text strong span {
    font-size: 22px;
    line-height: 31px;
    letter-spacing: 1px;
  }
  .ban_text {
    left: 2%;
  }
}
</style>

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
                        <p class="mx-md-5 px-5">Welcome to our adoption center! Find your perfect furry companion today and experience the joy of welcoming a new member into your family.</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('frontend.adoption') }}">Adopt Now</a>
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
                        <p class="mx-md-5 px-5">Explore our exclusive range of dog products designed to keep your canine companion happy, healthy, and tail-waggingly satisfied.</p>
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
                        <p class="mx-md-5 px-5">Discover purrfect products for your feline friend, ensuring they stay entertained, cozy, and contented all day long.</p>
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

<a href="{{ route('frontend.donation') }}" class="btn-dark btn btn-block w-24 rotate-90">Donate Now <i class='fas fa-paw'></i></a>

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
                                    <img class="card-img-top" src="{{ asset('uploads/pet/small/'.$petImage->image) }}" style="object-fit: cover; object-position: center; width: 100%; height: 260px;" >
                                @else
                                    <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                                @endif

                            </a>
                            <a onclick="addToFavouriteList({{ $pet->id }})" title="Add to favourites list" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>                            

                            <!-- <a title="Add to favourites list" class="whishlist" href="222"><i class="far fa-heart"></i></a>                             -->

                            
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
            <h2>Newest Pets</h2>
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
                                <img class="card-img-top" src="{{ asset('uploads/pet/small/'.$petImage->image) }}" style="object-fit: cover; object-position: center; width: 100%; height: 260px;" >
                            @else
                                <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                            @endif
                            
                        </a>
                        <a onclick="addToFavouriteList({{ $pet->id }})" title="Add to favourites list" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>                            
                        <!-- <a title="Add to favourites list" class="whishlist" href="222"><i class="far fa-heart"></i></a>                             -->

                        
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

<section class="ban_sec">
    <div class="container">
        <div class="ban_img">
            <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/0a1181f6-133f-416f-813a-4fa3ce6d7bd6/dgf5tih-dfac5edb-f0b5-4724-8986-5f65cdad433f.png/v1/fill/w_1280,h_431,q_80,strp/animals_pet_dog_banner_panorama_by_viaankart_dgf5tih-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzBhMTE4MWY2LTEzM2YtNDE2Zi04MTNhLTRmYTNjZTZkN2JkNlwvZGdmNXRpaC1kZmFjNWVkYi1mMGI1LTQ3MjQtODk4Ni01ZjY1Y2RhZDQzM2YucG5nIiwiaGVpZ2h0IjoiPD00MzEiLCJ3aWR0aCI6Ijw9MTI4MCJ9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS53YXRlcm1hcmsiXSwid21rIjp7InBhdGgiOiJcL3dtXC8wYTExODFmNi0xMzNmLTQxNmYtODEzYS00ZmEzY2U2ZDdiZDZcL3ZpYWFua2FydC00LnBuZyIsIm9wYWNpdHkiOjk1LCJwcm9wb3J0aW9ucyI6MC40NSwiZ3Jhdml0eSI6ImNlbnRlciJ9fQ.UmE_Jx6k7F1zw-tlc057l3KgIwk17BFgmo2PSMjk8aU" alt="banner" border="0">
            <div class="ban_text">
                <strong>
                    <span>Meeting current</span><br> needs now
                </strong>
                <p>You can prioritize a pet's well-being, ensuring they receive the necessary support for their mental, emotional, behavioral, and physical health.</p>
                <a href="{{ route('frontend.donation') }}">Donate Now</a>
            </div>
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
                            <a onclick="addToWishList({{ $product->id }})" title="Add to whishlist" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>                            
                            <!-- <a onclick="addToWishList({{ $product->id }})" title="Add to whishlist" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>                             -->

                            <div class="product-action">
                                @if($product->track_qty == 'Yes')
                                    @if($product->qty > 0)
                                        <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $product->id }});">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>     
                                    @else
                                        <a class="btn btn-dark" href="javacript:void(0);">
                                            Out of Stock
                                        </a> 
                                    @endif     
                                @else
                                    <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $product->id }});">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a> 
                                @endif                  
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
                        <a onclick="addToWishList({{ $product->id }})" title="Add to whishlist" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>                            

                        <div class="product-action">
                            @if($product->track_qty == 'Yes')
                                @if($product->qty > 0)
                                    <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $product->id }});">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>     
                                @else
                                    <a class="btn btn-dark" href="javacript:void(0);">
                                        Out of Stock
                                    </a> 
                                @endif     
                            @else
                                <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $product->id }});">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a> 
                            @endif                  
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