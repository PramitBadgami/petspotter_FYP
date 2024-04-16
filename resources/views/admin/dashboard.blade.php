@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalPets }}</h3>
                        <p>Total Pets</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('pets.index') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalAdoptedPets }}</h3>
                        <p>Total Pets Adopted</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('adoptions.index') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalVerifications }}</h3>
                        <p>Total Verifications</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('verifications.index') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('orders.index') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{  $totalProducts }}</h3>
                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>{{ $totalUsers }}</h3>
                        <p>Total Customers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('users.index') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            
            
            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>Rs.{{ number_format($totalRevenue) }}</h3>
                        <p>Total Sale</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>

            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>Rs.{{ number_format($revenueThisMonth) }}</h3>
                        <p>Revenue this Month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>

            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>Rs.{{ number_format($revenueLastMonth) }}</h3>
                        <p>Sales last Month({{$lastMonthName}})</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>

            <div class="col-lg-2 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        <h3>Rs.{{ number_format($revenueLastThirtyDays) }}</h3>
                        <p>Revenue last Month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
        </div>
    </div>					
    <!-- /.card -->
</section>
<!-- /.content -->
<br>
<center><u style= "color: orange;"><h1>Number of Users registered per month</h1></u></center>

<div stlye="width: 400px; margin: auto;">
    <canvas id="chart"></canvas>
</div>

@endsection

@section('customJs')
<script>
    console.log("hello")

    var ctx = document.getElementById('chart').getContext('2d');
    var userChart= new Chart(ctx,{
        type: 'bar',
        data:{
            labels: {!! json_encode($labels) !!},
            datasets: {!! json_encode($datasets) !!}
        },
    });
</script>
@endsection