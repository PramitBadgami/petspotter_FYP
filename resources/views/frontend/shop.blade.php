@extends('frontend.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="/">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-6 pt-5">
    <div class="container">
        <div class="row">            
            <div class="col-md-3 sidebar">
                <div class="sub-title">
                    <h2>Categories</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionExample">
                            
                            @if($categories->isNotEmpty())

                            @foreach($categories as $key => $category)

                            <div class="accordion-item">
                                @if($category->sub_category->isNotEmpty())
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $key }}" aria-expanded="false" aria-controls="collapseOne-{{ $key }}">
                                        {{$category->name}}
                                    </button>
                                </h2>
                                @else
                                <a href="{{ route("frontend.shop",$category->slug) }}" class="nav-item nav-link {{ ($categorySelected == $category->id) ? 'text-primary' : '' }}">{{$category->name}}</a>
                                @endif

                                @if($category->sub_category->isNotEmpty())
                                <div id="collapseOne-{{ $key }}" class="accordion-collapse collapse {{ ($categorySelected == $category->id) ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <div class="navbar-nav">
                                            @foreach($category->sub_category as $subCategory)
                                            <a href="{{ route("frontend.shop",[$category->slug,$subCategory->slug]) }}" class="nav-item nav-link {{ ($subCategorySelected == $subCategory->id) ? 'text-primary' : '' }}">{{$subCategory->name}}</a>
                                            @endforeach
                                                                                    
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                            @endif            
                                                
                        </div>
                    </div>
                </div>

                <div class="sub-title mt-5">
                    <h2>Brand</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        @if($brands->isNotEmpty())
                        @foreach($brands as $brand)
                        <div class="form-check mb-2">
                            <input {{ (in_array($brand->id, $brandsArray)) ? 'checked' : '' }} class="form-check-input brand-label" type="checkbox" name="brand[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                            <label class="form-check-label" for="brand-{{ $brand->id }}">
                                {{ $brand->name }}
                            </label>
                        </div>
                        @endforeach
                        @endif       
                    </div>
                </div>

                <div class="sub-title mt-5">
                    <h2>Price</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <input type="text" class="js-range-slider" name="my_range" value="" />
  
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                
                <div class="row pb-3">
                    
                    <div class="col-12 pb-1 d-flex gap-5">
                        <form action="{{ route('frontend.shop') }}" method="get" style= "width: 80%; height: 8%;">
                        <div class="input-group" style= "width: 80%; height: 8%;">
                            <input value="{{ Request::get('search') }}" type="text" placeholder="Search For Products" class="form-control" name="search" id="search">
                            <button type="submit" class="input-group-text">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        </form>
                        
                        <div class="d-flex align-items-center justify-content-end mb-4 ml-4">
                            
                            <div class="ml-2">

                                <select name="sort" id="sort" class="form-control">
                                    <option value="latest" {{ ($sort == 'latest') ? 'selected' : '' }}>Latest</option>
                                    <option value="price_desc" {{ ($sort == 'price_desc') ? 'selected' : '' }}>Price High</option>
                                    <option value="price_asc" {{ ($sort == 'price_asc') ? 'selected' : '' }}>Price Low</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                    @php
                        $productImage = $product->product_images->first();
                    @endphp
                    <div class="col-md-4">
                        <div class="card product-card" style="height: 410px;">
                            <div class="product-image position-relative">

                                <a href="{{ route("frontend.product",$product->slug) }}" class="product-img">
                                @if (!empty($productImage->image))
                                    <img class="card-img-top" src="{{ asset('uploads/product/small/'.$productImage->image) }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 20px;" >
                                @else
                                    <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" style="object-fit: cover; object-position: center; width: 100%; height: 200px;">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-frown-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m-2.715 5.933a.5.5 0 0 1-.183-.683A4.5 4.5 0 0 1 8 9.5a4.5 4.5 0 0 1 3.898 2.25.5.5 0 0 1-.866.5A3.5 3.5 0 0 0 8 10.5a3.5 3.5 0 0 0-3.032 1.75.5.5 0 0 1-.683.183M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8"/>
                                            </svg>
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


                    <div class="col-md-12 pt-5">
                        {{ $products->withQueryString()->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>

    rangeSlider = $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 5000,
        from: {{ ($priceMin) }},
        step: 10,
        to: {{ ($priceMax) }},
        skin: "round",
        max_postfix: "+",
        prefix: "Rs.",
        onFinish: function() {
            apply_filter();
        }
    });

    // Saving it's instance to var
    var slider = $(".js-range-slider").data("ionRangeSlider");

    $(".brand-label").change(function() {
        apply_filter();
    });

    $("#sort").change(function() {
        apply_filter();
    });

    function apply_filter() {
        var brands = [];
        
        $(".brand-label").each(function() {
            if ($(this).is(":checked") == true){
                brands.push($(this).val());
                
            }
        });


        var url =  '{{ url()->current() }}?';

        // Brand Filter
        if (brands.length > 0) { 
            url += '&brand='+brands.toString()
        }

        // Price Range Filter
        url += '&price_min=' +slider.result.from+'&price_max=' +slider.result.to;

        var keyword = $("#search").val();

        if (keyword.length > 0) {
            url += '&search=' + keyword;
        }

        // Sortings Filter
        url += '&sort=' + $("#sort").val();


        window.location.href = url;
    }

    

</script>

@endsection