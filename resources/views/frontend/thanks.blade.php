@extends('frontend.layouts.app')

@section('content')
    <section class="container">
        <div class="col-md-12 text-center py-5">

            @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif

            <h1>Thank you for ordering!!</h1>
            <p class="mt-2">Your order is: {{ $id }}</p>
        </div>
    </section>
@endsection