@extends('frontend.layouts.app')
<style>
.title {
    background-color: white; 
    border: 1px solid #ccc; 
    border-radius: 10px; 
    padding-left: 420px; 
    padding-right: 420px;
    padding-top: 10px; 
    padding-bottom: 10px; 
    display: inline-block; 
    margin: 0; 
}
</style>
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('frontend.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Favourites List</li>
                </ol>
            </div>
        </div>
    </section>
    <center><h1 class="title with-white-bg">My Favourites</h1></center>
    <section class="section-6 pt-5">
    
        <div class="container">
        
            <div class="row">    
                <div class="col-md-12">
                    @include('frontend.account.common.message')
                </div>  
                <div class="col-md-9">
                    <div class="row pb-3">
                        


                        @if ($favouritelists->isNotEmpty())
                        @foreach ($favouritelists as $favouritelist)
                        
                        <div class="col-md-4">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    
                                        @php
                                            $petImage = getPetImage($favouritelist->pet_id);
                                        @endphp
                                    <a href="{{ route('frontend.pet',$favouritelist->pet->slug) }}" class="product-img">
                                        @if (!empty($petImage))
                                            <img class="card-img-top" src="{{ asset('uploads/pet/small/'.$petImage->image) }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px;" >
                                        @else
                                            <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" style="object-fit: contain; object-position: center; width: 100%; height: 260px; padding: 5px;">
                                        @endif
                                    </a>
                                    <!-- <a title="Add to favourites list" class="whishlist" href="222"><i class="far fa-heart"></i></a>                             -->

                                   
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="{{ route('frontend.pet',$favouritelist->pet->slug) }}"><h6><strong>{{ $favouritelist->pet->name }}</strong></h6></a>
                                    <div class="price mt-2">
                                        <span class="h8">Age: {{ $favouritelist->pet->age }}</span>
                                        <span class="h8">- {{ $favouritelist->pet->gender }}</span>
                                    </div>
                                </div>   
                                <!-- <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center"> -->
                                    <button onclick="removePet({{ $favouritelist->pet_id }})" class="btn btn-outline-danger btn-sm" type="button"><i class="fas fa-trash-alt me-2"></i>Remove</button>
                                <!-- </div> -->
                            </div>                                               
                        </div>  

                        @endforeach
                        @else
                        <div>
                            <h3 class="h5">Your Favourites List is empty!!</h3>
                        </div>
                        @endif
                        
 

                        <div class="col-md-12 pt-5">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('customJs')
<script>
    function removePet(id){
        $.ajax({
            url: '{{ route("account.removePetFromFavouritelist") }}',
            type: "POST",
            data: {id:id},
            dataType: 'json',
            success: function(response) {
                if(response.status == true) {
                    window.location.href = "{{ route('account.favouritelist') }}";
                } 
            }
        });
    }

</script>
@endsection