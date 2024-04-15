@extends('frontend.layouts.app')

@section('content')
<br>
{{ $adoptions->id }}<br>
{{ $adoptions->answer_1 }}<br>
{{ $adoptions->answer_2 }}<br>
{{ $adoptions->answer_3 }}<br>
{{ $adoptions->answer_4 }}<br>
{{ $adoptions->answer_5 }}<br>
@php
    $petImage = $adoptions->pet->pet_images->first();
@endphp

@if (!empty($petImage->image))
<img src="{{ asset('uploads/pet/large/'.$petImage->image) }}" class="img-thumbnail" width="50" style="width: 20%;">
@else
<img src="{{ asset('admin-assets/img/default-150x150.png') }}"  class="img-thumbnail" width="50">
@endif
<br>
{{$adoptions->pet->name}}<br>
{{$adoptions->pet->age}}<br>
{{$adoptions->pet->gender}}<br>
{{$adoptions->pet->adoption_status}}<br>
    @if ($adoptions->pet->adoption_status== "Not Adopted")
        <span class="text-danger">Not Adopted</span>
    @elseif ($adoptions->pet->adoption_status == "In Progress")
        <span class="text-info">In Progress</span>
    @elseif ($adoptions->pet->adoption_status == "Adopted")
        <span class="text-success">Adopted</span>
    @endif
    <br><br>
{{$adoptions->user->name}}<br>
{{$adoptions->user->email}}<br>
{{$adoptions->user->phone}}<br><br>
<form action="" method="post" name="changeAdoptionStatusForm" id="changeAdoptionStatusForm">
<select name="status" id="status" class="form-control">
    <option value="pending" {{ ($adoptions->pet->adoption_status== "Not Adopted") ? 'selected' : '' }}>Not Adopted</option>
    <option value="shipped" {{ ($adoptions->pet->adoption_status == "In Progress") ? 'selected' : '' }}>In Progress</option>
    <option value="delivered" {{ ($adoptions->pet->adoption_status == "Adopted") ? 'selected' : '' }}>Adopted</option>
</select>
<button>submit</button>


@endsection

@section('content')
<script>
$("#changeAdoptionStatusForm").submit(function(event){
    event.preventDefault();

    $.ajax({
        url: '{{ route("adoptions.changeAdoptionStatus", $adoptions->id) }}',
        type: 'put',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){

        }
    })
});
</script>
@endsection