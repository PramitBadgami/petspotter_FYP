@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <!-- <div class="col-sm-6 text-right">
                    <a href="{{ route('productcategories.create') }}" class="btn btn-primary">New Category</a>
                </div> -->
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
                            <button type="button" onclick="window.location.href='{{ route("users.index") }}'" class="btn btn-default btn-sm">Reset</button>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <!-- <th width="100">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Showing the dynamic categories -->
                            @if ($users->isNotEmpty())
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @if ($user->status == "Unverified")
                                            <span class="badge bg-danger">Unverified</span>
                                        @elseif ($user->status == "In Progress")
                                            <span class="badge bg-info">In Progress</span>
                                        @elseif ($user->status == "Verified")
                                            <span class="badge bg-success">Verified</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
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
                    {{ $users->links()}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJs')
<script>
    function deleteCategory(id){

        var url = '{{ route("productcategories.delete","ID") }}';
        var newUrl = url.replace("ID",id)


        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){

                    if(response["status"]) {

                        window.location.href="{{ route('productcategories.index') }}"
                    }
                }
            });
        }
    }
</script>
@endsection