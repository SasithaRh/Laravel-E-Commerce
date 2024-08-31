
@extends('admin.layouts.app')
@section('style')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">



            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Total Orders</span>
                  <span class="info-box-number">{{ $total_orders }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-list-alt"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Today  Orders</span>
                    <span class="info-box-number">{{ $today_orders }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-primary elevation-1"><i class="fa-sharp fa-solid fa-dollar-sign"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Total Payements</span>
                    <span class="info-box-number">$ {{ $total_payements }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Total Customers</span>
                    <span class="info-box-number">{{ $total_customers }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

          </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Sales</h3>
                  <select name="" id="" class="form-control Changeyear" style="width: 100px">
                    @for ($i=2022;$i<=date('Y'); $i++)
                        <option {{ ($year == $i) ? 'selected':''}} value="{{ $i }}">{{ $i }}</option>

                    @endfor
                  </select>

                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$ {{ $total_payements }}</span>
                    <span>Sales Over Time</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-charts" height="300"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Customers
                  </span>

                  <span class="mr-2">
                    <i class="fas fa-square text-gray"></i> Orders
                  </span>

                  <span>
                    <i class="fas fa-square text-danger"></i> Amount
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Latest Orders</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card">

                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Country</th>
                                <th>Address</th>
                                <th>City</th>

                                <th>Passcode</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Total Amount</th>
                                <th >Pay Method</th>

                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latest_orders as $key => $detail)
                                <tr>
                                    <td>{{ $detail['id'] }}</td>
                                    <td class="text-sm">{{ $detail['first_name'] }}</td>
                                    <td class="text-sm">{{ $detail['company'] }}</td>
                                    <td class="text-sm">{{ $detail['country'] }}</td>
                                    <td class="text-sm">{{ $detail['address1'] }}</td>
                                    <td class="text-sm">{{ $detail['city'] }}</td>

                                    <td class="text-sm">{{ $detail['pastcode'] }}</td>
                                    <td class="text-sm">{{ $detail['phone'] }}</td>
                                    <td class="text-sm">{{ $detail['email'] }}</td>
                                    <td class="text-sm">$ {{ $detail['amount'] }}</td>
                                    <td class="text-sm">{{ $detail['payment_method'] }}</td>


                                    <td ><a href="{{ route('details.order', $detail['id']) }}"
                                        class="btn btn-primary btn-sm mr-1">Details</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->

        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
</div>
    @endsection

    @section('script')
    <script src="{{ asset('assest/plugins/chart.js/Chart.min.js')}}"></script>
 <script src="{{ asset('assest/dist/js/pages/dashboard3.js')}}"></script>

<SCript>
    $('.Changeyear').change(function (e) {
        e.preventDefault();
        var year = $(this).val();
        window.location.href = "{{ url('admin/dashboard?year=') }}"+year;

    });
     var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-charts')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['JAN','FEB','MAR','APR','MAY','JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [{{ $getTotalCustomersMonth }}]
        },
        {
          backgroundColor: '#ced4da',
          borderColor: '#ced4da',
          data: [{{ $getTotalOrdersMonth }}]
        },
        {
          backgroundColor: '#dc3545',
          borderColor: '#dc3545',
          data: [{{ $getTotalPaymentsMonth }}]
        }

      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
</SCript>

    @endsection
