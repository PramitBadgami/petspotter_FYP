@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Donations</h1>
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
                            <button type="button" onclick="window.location.href='{{ route("donations.list") }}'" class="btn btn-default btn-sm">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input value="{{ Request::get('search') }}" type="text" name="search" class="form-control float-right" placeholder="Search">
            
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
                                
                                <th>Users</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Amount</th>
                                <th>Donated at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Showing the dynamic categories -->
                            @if ($donations->isNotEmpty())
                                @foreach ($donations as $donation)
                                
                                <tr>
                                <td>{{ $donation->id }}</td>
                                    
                                    <td>{{ $donation->name }}</td>
                                    <td>{{ $donation->email }}</td>

                                    <td>{{ $donation->phone }}</td>
                                    <td>Rs. <span style="color: green;">{{ $donation->amount }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($donation->created_at)->format('d M, Y') }}</td>

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
                    {{ $donations->links()}}
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