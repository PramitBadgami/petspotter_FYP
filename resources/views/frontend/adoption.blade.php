@extends('frontend.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('frontend.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Adoption</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">            
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Pet Categories</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                
                            @if($categories->isNotEmpty())
                            
                            @foreach($categories as $key => $category)

                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingOne" style="font-size: 16px">
                                        
                                        <a href="{{ route('frontend.adoption',$category->slug) }}" class="nav-item nav-link {{ ($categorySelected == $category->id) ? 'text-primary' : '' }}">{{$category->name}}</a>
                                        
                                    </h6>
                                    
                                </div>  

                                @endforeach
                                @endif
               
                                                    
                            </div>
                        </div>
                    </div>

                    

                    <div class="sub-title mt-5">
                        <h2>Breeds</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            @if ($breeds->isNotEmpty())
                            @foreach($breeds as $breed)
                            <div class="form-check mb-2">
                                <input {{ (in_array($breed->id, $breedsArray)) ? 'checked' : '' }} class="form-check-input breed-label" type="checkbox" name="breed[]" value="{{ $breed->id }}" id="breed-{{$breed->id}}">
                                <label class="form-check-label" for="breed-{{$breed->id}}">
                                    {{$breed->breed}}
                                </label>
                            </div>
                            @endforeach
                            @endif

                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Age</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="js-range-slider" name="my_range" value="" />

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <div class="ml-2">
                                <select name="sort" id="sort" class="form-control">
                                    <option value="latest" {{ ($sort == 'latest') ? 'selected' : '' }}>Latest</option>
                                    <option value="age_desc" {{ ($sort == 'age_desc') ? 'selected' : '' }}>Age High</option>
                                    <option value="age_asc" {{ ($sort == 'age_asc') ? 'selected' : '' }}>Age Low</option>
                                </select>
                                </div>
                            </div>
                        </div>


                        @if ($pets->isNotEmpty())
                        @foreach ($pets as $pet)
                        @php
                            $petImage = $pet->pet_images->first();
                        @endphp
                        <div class="col-md-4">
                            <div class="card product-card">
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
                                    <a class="h6 link" href="{{ route('frontend.pet',$pet->slug) }}"><h6><strong>{{ $pet->name }}</strong></h6></a>
                                    <div class="price mt-2">
                                        <span class="h8">Age: {{ $pet->age }}</span>
                                        <span class="h8">- {{ $pet->gender }}</span>
                                    </div>
                                </div>                        
                            </div>                                               
                        </div>  

                        @endforeach
                        @endif
                        
 

                        <div class="col-md-12 pt-5">
                            {{ $pets->withQueryString()->links() }}
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
        max: 50,
        from: {{ ($ageMin) }},
        step: 1,
        to: {{ ($ageMax) }},
        skin: "round",
        max_postfix: "+",
        prefix: "Age=",
        onFinish: function() {
            apply_filters();
        }
    });
    
    // Saving it's instance to var
    var slider = $(".js-range-slider").data("ionRangeSlider");


    $(".breed-label").change(function(){
        apply_filters();
    });

    $("#sort").change(function() {
        apply_filters();
    });

    function apply_filters() {
        var breeds = [];

        $(".breed-label").each(function() {
            if ($(this).is(":checked") == true){
                breeds.push($(this).val());
                
            }
        });

        // console.log(breeds.toString());

        var url =  '{{ url()->current() }}?';

        // Breed Filter
        if (breeds.length > 0) { 
            url += '&breeds='+breeds.toString()
        }

        // Price Range Filter
        url += '&age_min=' +slider.result.from+'&age_max=' +slider.result.to;

        // Sortings Filter
        url += '&sort=' + $("#sort").val();

        window.location.href = url;
    }
</script>
@endsection