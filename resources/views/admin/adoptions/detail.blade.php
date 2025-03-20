@extends('admin.layouts.app') 

@section('content')

<style>
    section{
        background-color: white;
    }

    .custom-dropdown {
        width: 300px;
    }
</style>

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('adoptions.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
        
            <div class="row">
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Personal Questions (#{{ $adoptions->id }})</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">
                                
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_1">Q1. Why do you want to adopt this pet ({{$adoptions->pet->name}})? <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_1" readonly id="question_1" cols="30" rows="3" placeholder="Please tell us why you're interested in adopting this particular pet." class="form-control">{{ $adoptions->answer_1 }}</textarea>
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_2">Q2. Are you financially prepared to cover the costs associated with pet ownership, including food, supplies, grooming, training, and medical expenses? <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_2" readonly id="question_2" cols="30" rows="3" placeholder="Please describe your financial readiness to cover pet expenses." class="form-control">{{ $adoptions->answer_2 }}</textarea>
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_3">Q3. Have you ever adopted a pet before? (if yes, please describe) <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_3" readonly id="question_3" cols="30" rows="3" placeholder="If yes, please share your past experience with pet adoption." class="form-control">{{ $adoptions->answer_3 }}</textarea>
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_4">Q4. Do you currently own any other pets? (if yes, please describe) <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_4" readonly id="question_4" cols="30" rows="3" placeholder="If yes, please provide details about your current pets." class="form-control">{{ $adoptions->answer_4 }}</textarea>
                                        <p></p>
                                    </div>            
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="mb-3">
                                        <label for="question_5">Q5. What is your living situation like? Do you live in a house/apartment/rented place? <span class="required" style="color: red;">*</span></label>
                                        <textarea name="question_5" readonly id="question_5" cols="30" rows="3" placeholder="Describe your current living situation..." class="form-control">{{ $adoptions->answer_5 }}</textarea>
                                        <p></p>
                                    </div>            
                                </div>
                            </div>
                        </div>
                    </div>    
                    <div class="sub-title mt-5">
                        <h2>Adoption Status</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                        <form action="{{ route('adoptions.changeAdoptionStatus', $adoptions->id) }}" method="post" name="changeAdoptionStatusForm" id="changeAdoptionStatusForm">
                            <div class="row">
                                <div class="mb-3">
                                    <div>
                                        <select name="status" id="status" class="form-control custom-dropdown">
                                            <option value="not adopted" {{ ($adoptions->pet->adoption_status== "Not Adopted") ? 'selected' : '' }}>Not Adopted</option>
                                            <option value="in progress" {{ ($adoptions->pet->adoption_status == "In Progress") ? 'selected' : '' }}>In Progress</option>
                                            <option value="adopted" {{ ($adoptions->pet->adoption_status == "Adopted") ? 'selected' : '' }}>Adopted</option>
                                        </select>
                                    </div><br>
                                    <div>
                                        <label for="">Adoption Date</label>

                                        <input value="{{ $adoptions->pet->adoption_date }}" type="text" name="adoption_date" id="adoption_date" class="form-control" placeholder="Adoption Date">
                                    </div>
                                    <div>
                                        <button class="btn btn-primary mt-3">Update</button>
                                    </div>
                                </div>
                   
                            </div>
                        </form>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sub-title">
                        <h2>User Details</h2>
                    </div>                    
                    <div class="card cart-summery" style= "width: 110%;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h5"><b>User Name:</b> {{$adoptions->user->name}}</div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h5"><b>User Email:</b> {{$adoptions->user->email}}</div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h5"><b>User Phone:</b> {{$adoptions->user->phone}}</div>
                               
                            </div>                
                        </div>
                    </div><br>
                    <div class="sub-title">
                        <h2>Pet Details</h2>
                    </div>                    
                    <div class="card cart-summery" style= "width: 110%;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2">
                                @php
                                    $petImage = $adoptions->pet->pet_images->first();
                                @endphp

                                @if (!empty($petImage->image))
                                    <img src="{{ asset('uploads/pet/large/'.$petImage->image) }}" class="img-thumbnail" width="50" style="width: 100%;">
                                @else
                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}"  class="img-thumbnail" width="50">
                                @endif
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h5"><b>Pet Name:</b> {{$adoptions->pet->name}}</div>
                            </div>
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h5"><b>Pet Age:</b> {{$adoptions->pet->age}}</div>
                            </div>   
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h5"><b>Pet Gender:</b> {{$adoptions->pet->gender}}</div>
                            </div>   
                            <div class="d-flex justify-content-between pb-2">
                                @if ($adoptions->pet->adoption_status== "Not Adopted")
                                    <div class="h5"><b>Adoption Status:</b><span class="text-danger"> Rejected</span>
                                @elseif ($adoptions->pet->adoption_status == "In Progress")
                                    <div class="h5"><b>Adoption Status:</b><span class="text-info"> In Progress</span>
                                @elseif ($adoptions->pet->adoption_status == "Adopted")
                                <div class="h5"><b>Adoption Status:</b><span class="text-success"> Adopted</span>
                                @endif
                            </div>             
                        </div>
                    </div>   
                    

                    
                </div>
            </div>
        
    </div>
</section>



@endsection

@section('customJs')
<script>
    $(document).ready(function(){
        $('#adoption_date').datetimepicker({
            // options here
            format:'Y-m-d H:i:s',
        });
    });

    $("#changeAdoptionStatusForm").submit(function(event){
        event.preventDefault();

        if (confirm("Are you sure you want to change status?")) {
            $.ajax({
                url: '{{ route("adoptions.changeAdoptionStatus", $adoptions->id) }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response){
                    window.location.href = '{{ route("adoptions.detail",$adoptions->id) }}';
                    if(response.status) {
                    // Display success message
                    alert('Adopted status updated successfully');
                    }
                }
            });
        }
    });

    
</script>
@endsection
