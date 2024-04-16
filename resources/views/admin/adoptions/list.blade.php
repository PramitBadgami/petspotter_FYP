@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Adoptions</h1>
                </div>
                <div class="col-sm-6 text-right">
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <form action="" method="get">

                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" onclick="window.location.href='{{ route("adoptions.index") }}'" class="btn btn-default btn-sm">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
            
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>   
                        
                    </div>
                </form>
                <div class="card-body table-responsive p-0">								
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">Id</th>
                                <th width="80"></th>
                                <th>Pet Name</th>
                                <th>Pet Age</th>
                                <th>Users</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Adoption Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Showing the dynamic categories -->
                            @if ($adoptions->isNotEmpty())
                                @foreach ($adoptions as $adoption)
                                @php
                                    $petImage = $adoption->pet->pet_images->first();
                                @endphp
                                <tr>
                                <td><a href="{{ route('adoptions.detail',$adoption->id) }}">{{ $adoption->id }}</a></td>
                                    <td>
                                        @if (!empty($petImage->image))
                                        <img src="{{ asset('uploads/pet/small/'.$petImage->image) }}" class="img-thumbnail" width="50" >
                                        @else
                                        <img src="{{ asset('admin-assets/img/default-150x150.png') }}"  class="img-thumbnail" width="50">
                                        @endif
                                    
                                    </td>
                                    <td>{{ $adoption->pet->name }}</td>
                                    <td>{{ $adoption->pet->age }}</td>

                                    <td>{{ $adoption->user->name }}</td>
                                    <td>{{ $adoption->user->email }}</td>
                                    <td>{{ $adoption->user->phone }}</td>

                                    

                                    <td>

                                        @if ( $adoption->pet->adoption_status == 'Not Adopted')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif ($adoption->pet->adoption_status == 'In Progress')
                                            <span class="badge bg-info">In Progress</span>
                                        @elseif ($adoption->pet->adoption_status == 'Adopted')
                                            <span class="badge bg-success">Adopted</span>
                                        @endif
                                    

                                    </td>
                                    <td>
                                    <a href="{{ route('adoptions.detail',$adoption->id) }}"><button type="button" class="btn btn-outline-secondary"><i class="fa fa-eye"></i> View</button></a>
                                    </td>
                                   
                                    
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">Records Not Found</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>										
                </div>
                <div class="card-footer clearfix">
                    {{ $adoptions->links()}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
<script>

</script>
@endsection