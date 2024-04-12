@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Verifications</h1>
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
                            <button type="button" onclick="window.location.href='{{ route("orders.index") }}'" class="btn btn-default btn-sm">Reset</button>
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
                                <th width="60">Order#</th>
                                <th>Users</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Province</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Showing the dynamic categories -->
                            @if ($verifications->isNotEmpty())
                                @foreach ($verifications as $verification)
                                <tr>
                                    <td><a href="#">{{ $verification->id }}</a></td>
                                    <td>{{ $verification->name }}</td>
                                    <td>{{ $verification->email }}</td>
                                    <td>{{ $verification->mobile }}</td>
                                    
                                    <td>

                                    
                                        
                                    
                                    
                                        @if ($verification->user->status == "Unverified")
                                            <span class="badge bg-danger">Unverified</span>
                                        @elseif ($verification->user->status == "In Progress")
                                            <span class="badge bg-info">In Progress</span>
                                        @elseif ($verification->user->status == "Verified")
                                            <span class="badge bg-success">Verified</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    
                                   
                                    </td>
                                    <td>{{ $verification->province }}</td>
                                    <td>
                                    <button type="button" class="btn btn-outline-secondary"><i class="fa fa-eye"></i> View</button>
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
                    {{ $verifications->links('pagination::bootstrap-5')}}
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