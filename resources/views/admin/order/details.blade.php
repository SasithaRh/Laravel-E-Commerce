@extends('admin.layouts.app')
@section('style')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Order Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item ">Order List</li>
                        <li class="breadcrumb-item active">Order Details</li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="form-group">


                            <label>Order Id : {{ $details['id'] }}</label>

                        </div>


                        <div class="form-group">
                            <label>Full Name : {{ $details['first_name'] }} {{ $details['last_name'] }}</label>

                        </div>



                        <div class="form-group">
                            <label>Company Name : {{ $details['company'] }}</label>

                        </div>
                        <div class="form-group">
                            <label>Country : {{ $details['country'] }}</label>

                        </div>
                        <div class="form-group">
                            <label>Address : {{ $details['address1'] }} , {{ $details['address2'] }}</label>

                        </div>
                        <div class="form-group">
                            <label>City/State : {{ $details['city'] }} / {{ $details['state'] }}</label>

                        </div>

                        <div class="form-group">
                            <label>Pastcode : {{ $details['pastcode'] }}</label>

                        </div>
                        <div class="form-group">
                            <label>Phone : {{ $details['phone'] }}</label>

                        </div>
                        <div class="form-group">
                            <label>Email : {{ $details['email'] }}</label>

                        </div>
                        <div class="form-group">
                            <label>Total Amount : $ {{ $details['amount'] }}</label>

                        </div>
                        <div class="form-group">
                            <label>Payment Method : {{ $details['payment_method'] }}</label>

                        </div>
                        <div class="form-group">
                            <label>Note : {{ $details['note'] }}</label>

                        </div>
                        <div class="form-group">
                            <label>Created Date : {{ $details['created_at'] }}</label>

                        </div>

                    </div>
                    <!-- /.card -->
                </div>


            </div>
            <div class="card">
                <div class="card-header">
                        <div class="col-sm-12">
                            <h3 class="card-title">Prodcut Details</h3>
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
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Size Name</th>
                                <th>Total Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $getOrder = App\Models\Order::find($details['id']);
                            $orderItems = $getOrder->getItem;

                        @endphp
                            @foreach ($orderItems as $key => $detail)
                            @php

        // Retrieve the product image based on prodcut_id
        $getproductimage = App\Models\Prodct_Image::where('prodcut_id', $detail->getProduct->id)->firstOrFail();

                        @endphp
                                <tr>
                                    <td class="text-sm">  <img src="{{ asset('storage/upload/products/' .$getproductimage->image_name) }}" height="100px"></td>
                                    <td class="text-sm"><a href="{{ url($detail->getProduct->slug) }}" target="_blank" rel="noopener noreferrer"> {{ $detail->getProduct->title}}</a></td>
                                    <td class="text-sm">{{ $detail['quantity'] }}</td>
                                    <td class="text-sm">$ {{ number_format($detail['price'],2) }}</td>
                                    <td class="text-sm">{{ $detail['size_name'] }}</td>
                                    <td class="text-sm">$ {{ $detail['total_amount'] }}</td>
                                    {{-- <td class="text-sm">{{ $detail['company'] }}</td>
                                    <td class="text-sm">{{ $detail['country'] }}</td>
                                    <td class="text-sm">{{ $detail['address1'] }}</td>
                                    <td class="text-sm">{{ $detail['city'] }}</td>

                                    <td class="text-sm">{{ $detail['pastcode'] }}</td>
                                    <td class="text-sm">{{ $detail['phone'] }}</td>
                                    <td class="text-sm">{{ $detail['email'] }}</td>
                                    <td class="text-sm">$ {{ $detail['amount'] }}</td>
                                    <td class="text-sm">{{ $detail['payment_method'] }}</td>
                                    <td class="text-sm">{!! $detail['status'] == 1
                                        ? '<p class="text-success text-bold">Active</p>'
                                        : '<p class="text-danger text-bold">InActive</p>' !!}</td>
                                    <td ><a href="{{ route('details.order', $detail['id']) }}"
                                        class="btn btn-primary btn-sm mr-1">Details</a>
                                    </td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>

</div>
@endsection

@section('script')
<script src="{{ asset('assest/dist/js/pages/dashboard3.js') }}"></script>

@endsection
