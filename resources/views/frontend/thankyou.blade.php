@extends('frontend.layouts.app')

@section('content')
    <section class="container">
        <div class="col-md-12 text-center py-5">

            <h1>Your Donation was: {{ $msg }}</h1>
            <p class="mt-2">{{ $msg1 }}</p>

            <a class="btn-dark btn btn-block w-20" href="{{ route('frontend.home') }}">Home</a>
        </div>
    </section>
@endsection