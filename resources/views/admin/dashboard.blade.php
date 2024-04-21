@extends('admin.layouts.app')

@section('content')
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
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-5">							
                <div class="small-box card bg-info">
                    <div class="inner">
                        <h3>{{ $totalPets }}</h3>
                        <p>Total Pets</p>
                    </div>
                    <div class="icon">
                        <i class='fas fa-dog'></i>
                    </div>
                    <a href="{{ route('pets.index') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">							
                <div class="small-box card  bg-success">
                    <div class="inner">
                        <h3>{{ $totalAdoptedPets }}</h3>
                        <p>Total Pets Adopted</p>
                    </div>
                    <div class="icon">
                    <i class='fas fa-cat'></i>
                    </div>
                    <a href="{{ route('adoptions.index') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">							
                <div class="small-box card bg-warning">
                    <div class="inner">
                        <h3>{{ $totalVerifications }}</h3>
                        <p>Total Verifications</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <a href="{{ route('verifications.index') }}" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">							
                <div class="small-box card bg-danger">
                    <div class="inner">
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-bag"></i>
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
                        <h3>Rs.{{ number_format($totalDonations) }}</h3>
                        <p>Total Donations</p>
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
                        <p>Revenue last 30 days</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
        </div>
    </div>					
</section>
<br>

<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Online Website Visitors</h3>
                  <a href="{{ route('users.index') }}">View Users</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">{{ $totalUsers }}</span>
                    <span>Visitors Over Time</span>
                  </p>
                </div>

                <div class="position-relative mb-4">
                  <canvas id="chart" height="200"></canvas>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">User Status</h3>
                  <a href="{{ route('users.index') }}">View Users</a>
                </div>
              </div>
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="userStatusChart" width="450" height="250"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                  <a href="{{ route('orders.index') }}">View Orders</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Rs. {{ $salesPreviousWeek }}</span>
                    <span>Previous week sales</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                        @php
                            $percentageChange = ($salesThisWeek - $salesPreviousWeek) / $salesPreviousWeek * 100;
                        @endphp
                        <span class="{{ $percentageChange > 0 ? 'text-success' : ($percentageChange < 0 ? 'text-danger' : '') }}">
                            <i class="fas fa-arrow-{{ $percentageChange > 0 ? 'up' : 'down' }}"></i> {{ number_format(abs($percentageChange), 2) }}%
                        </span>
                    <span class="text-muted">Since last week</span>
                  </p>
                </div>

                <div class="position-relative mb-4">
                    <canvas id="salesChart" width="400" height="265"></canvas>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Stats
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">User Province</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Pet Adoption Status</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content p-0">
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                       <canvas id="userProvinceChart" width="400" height="230"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="petStatusChart" width="300" height="300"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 


@endsection

@section('customJs')
<script>
    var ctx = document.getElementById('chart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: {!! json_encode($datasets) !!}
        },
        options: {
            legend: {
                display: false
            }
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels2) !!},
            datasets: [{
                label: 'Sales',
                data: {!! json_encode($data) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('userStatusChart').getContext('2d');
    var userStatusChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labels3) !!},
            datasets: [{
                data: {!! json_encode($data3) !!},
                backgroundColor: {!! json_encode($colors3) !!}
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20 // Adding padding to the legend labels
                }
            }
            
        }
    });
</script>

<script>
    var ctx = document.getElementById('userProvinceChart').getContext('2d');
    var userProvinceChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: {!! json_encode($labels4) !!},
            datasets: [{
                label: 'Number of Users',
                data: {!! json_encode($data4) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 0, 0, 0.5)',
                    'rgba(0, 255, 0, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 0, 0, 1)',
                    'rgba(0, 255, 0, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: true // Showing the legend
            },
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('petStatusChart').getContext('2d');
    var petStatusChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($labels5) !!},
            datasets: [{
                data: {!! json_encode($data5) !!},
                backgroundColor: {!! json_encode($colors5) !!}
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    padding: 20 // Adding padding to the legend labels
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                        return data.labels[tooltipItem.index] + ': ' + currentValue + ' (' + percentage + '%)';
                    }
                }
            }
        }
    });
</script>

@endsection