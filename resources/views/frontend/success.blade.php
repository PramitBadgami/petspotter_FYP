@extends('frontend.layouts.app')

@section('content')
<section class="container">
    <div class="col-md-12 text-center py-5">

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
        <h1>Thank you!!</h1><br>
        <p class="h4">Your adoption request has been sent to us. You will be contacted for the further adoption process from out representatives.</p>
    </div>
</section>
@endsection