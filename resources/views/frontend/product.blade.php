@extends('frontend.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.shop') }}">Shop</a></li>
                <li class="breadcrumb-item">{{ $product->title }}</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-7 pt-3 mb-3">
    <div class="container">
        <div class="row ">
            <div class="col-md-5">
                <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner bg-light">
                        
                        @if ($product->product_images)
                            @foreach ($product->product_images as $key => $productImage)
                            <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}">
                                <img class="w-100 h-90" src="{{ asset('uploads/product/large/'.$productImage->image) }}" alt="Image">
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
            <div class="col-md-7">
                <div class="bg-light right">
                    <h1>{{ $product->title }}</h1>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>

                    @if($product->compare_price > 0)
                    <h2 class="price text-secondary"><del>Rs.{{ $product->compare_price }}</del></h2>
                    @endif
                    <h2 class="price ">Rs.{{ $product->price }}</h2>

                    {!! $product->short_description !!}
                    
                    <!-- <a href="javascript:void(0);" onclick="addToCart({{ $product->id }})" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART</a> -->
                
                    
                    @if($product->track_qty == 'Yes')
                        @if($product->qty > 0)
                            <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $product->id }});">
                                <i class="fa fa-shopping-cart"></i> &nbsp;Add To Cart
                            </a>     
                        @else
                            <a class="btn btn-dark" href="javacript:void(0);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m-2.715 5.933a.5.5 0 0 1-.183-.683A4.5 4.5 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.5 3.5 0 0 0 8 10.5a3.5 3.5 0 0 0-3.032 1.75.5.5 0 0 1-.683.183M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8"/>
                            </svg>
                            Out of Stock
                            </a> 
                        @endif     
                    @else
                        <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $product->id }});">
                            <i class="fa fa-shopping-cart"></i> &nbsp;Add To Cart
                        </a> 
                    @endif                  
                        
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <div class="bg-light">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                        {!! $product->shipping_returns !!}
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        
                        </div>
                    </div>
                </div>
            </div> 
        </div>           
    </div>
</section>

@if(!empty($relatedProducts))
<section class="pt-5 section-8">
    <div class="container">
        <div class="section-title">
            <h2>Recommended Products</h2>
        </div> 
        <div class="col-md-12">
            <div id="related-products" class="carousel">
                @foreach($relatedProducts as $relProduct)
                @php
                    $productImage = $relProduct->product_images->first();
                @endphp
                <div class="card product-card"  style="height: 430px;">
                    <div class="product-image position-relative">

                        <a href="" class="product-img">
                            @if (!empty($productImage->image))
                            <img class="card-img-top" src="{{ asset('uploads/product/small/'.$productImage->image) }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 10px;">
                            @else
                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}"  style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                            @endif
                        </a>

                        <a onclick="addToWishList({{ $relProduct->id }})" title="Add to whishlist" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>                                                      

                        <div class="product-action">
                            @if($relProduct->track_qty == 'Yes')
                                @if($relProduct->qty > 0)
                                    <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $relProduct->id }});">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>     
                                @else
                                    <a class="btn btn-dark" href="javacript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m-2.715 5.933a.5.5 0 0 1-.183-.683A4.5 4.5 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.5 3.5 0 0 0 8 10.5a3.5 3.5 0 0 0-3.032 1.75.5.5 0 0 1-.683.183M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8"/>
                                    </svg>
                                    Out of Stock
                                    </a> 
                                @endif     
                            @else
                                <a class="btn btn-dark" href="javacript:void(0);" onclick="addToCart({{ $relProduct->id }});">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a> 
                            @endif                  
                        </div>
                    </div>                        
                    <div class="card-body text-center mt-3">
                        <a class="h6 link" href="">{{ $relProduct->title }}</a>
                        <div class="price mt-2">
                            <span class="h5"><strong>Rs.{{ $relProduct->price }}</strong></span>
                            @if($relProduct->compare_price > 0)
                            <span class="h6 text-underline"><del>Rs.{{ $relProduct->compare_price }}</del></span>
                            @endif
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

@section('customJs')

@endsection