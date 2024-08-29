@extends('admin.layouts.app')
@section('style')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Order List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Order List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @include('admin.layouts.messages')
        <div class="card">
            <div class="card-header">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <h3 class="card-title">Order List Table</h3>
                    </div>
                    {{-- <div class="col-sm-2">
                        <a href="{{ route('create.Order') }}" class="text-white"><button type="button"
                                class="btn btn-block btn-primary btn-sm">Add New Order</button></a>
                    </div> --}}
                </div>
            </div>
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
                            <th >Status</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $key => $detail)
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
                                <td class="text-sm">
                                    <select name="status"  id="{{ $detail['id'] }}" class="form-control ChangeStatus">
                                        <option {{ $detail->status === 0 ? 'selected' : '' }} value='0'>Pending</option>
                                        <option {{ $detail->status === 1 ? 'selected' : '' }} value='1'>Inprogress</option>
                                        <option {{ $detail->status === 2 ? 'selected' : '' }} value='2'>Delivered</option>
                                        <option {{ $detail->status === 3 ? 'selected' : '' }} value='3'>Completed</option>
                                        <option {{ $detail->status === 4 ? 'selected' : '' }} value='4'>Cancelled</option>
                                    </select>
                                </td>

                                <td ><a href="{{ route('details.order', $detail['id']) }}"
                                    class="btn btn-primary btn-sm mr-1">Details</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex justify-content-center" style="margin-top: 20px;">
                    {{ $details->links() }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>

    </div>

@endsection

@section('script')
<script>


                $('.ChangeStatus').change(function (e) {
            e.preventDefault();
            var status  = $('.ChangeStatus').val();
            var order_id  = $(this).attr('id');

             xhr = $.ajax({
            type: "GET",
            url: "{{ url('admin/orders_status') }}",
            data: {

                "status":status,
                "order_id":order_id,
            },
            dataType: "json",
            success: function(data) {
                alert(data.message)
            },
            error: function(data) {

            }
        })
    })

</script>
    <script src="{{ asset('assest/dist/js/pages/dashboard3.js') }}"></script>

@endsection
