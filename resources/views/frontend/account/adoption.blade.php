@extends('frontend.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a></li>
                <li class="breadcrumb-item">Adoptions</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="row">
            <div class="col-md-12">
            @include('frontend.account.common.message')
            </div>
            <div class="col-md-3">
                @include('frontend.account.common.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">My Adoptions</h2>
                    </div>
                    <form action="" name="profileForm" id="profileForm">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead> 
                                        <tr>
                                            <th>Id</th>
                                            <th width="80"></th>
                                            <th>Pet Name</th>
                                            <th>Pet Age</th>
                                            <th>Pet Gender</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($adoptions->isNotEmpty())
                                            @foreach ($adoptions as $adoption)
                                            @php
                                                $petImage = $adoption->pet->pet_images->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $adoption->id }}</td>
                                                <td>
                                                    @if (!empty($petImage->image))
                                                    <img src="{{ asset('uploads/pet/small/'.$petImage->image) }}" class="img-thumbnail" width="50" >
                                                    @else
                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}"  class="img-thumbnail" width="50">
                                                    @endif
                                                
                                                </td>
                                                <td>{{ $adoption->pet->name }}</td>
                                                
                                                <td>{{ $adoption->pet->age }}</td>
                                                <td>{{ $adoption->pet->gender }}</td>
                                                <td>{{ \Carbon\Carbon::parse($adoption->created_at)->format('d M, Y') }}</td>
                                                <td>
                                                @if ($adoption->pet->adoption_status == 'Not Adopted')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @elseif ($adoption->pet->adoption_status == 'In Progress')
                                                    <span class="badge bg-info">In Progress</span>
                                                @elseif ($adoption->pet->adoption_status == 'Adopted')
                                                    <span class="badge bg-success">Adopted</span>
                                                @endif
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                        
                                           @else
                                            <tr>
                                                <td colspan="3">No Adoptions Found</td>
                                            </tr>
                                        
                                        @endif
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $adoptions->links() }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection