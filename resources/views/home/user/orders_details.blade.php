@extends('home.layouts.app')
@section('style')

@endsection
@section('content')
<main class="main">
    <div class="page-header text-center"
        style="background-image: url({{ asset('assest/assets/images/page-header-bg.jpg')}})">
        <div class="container">
            <h1 class="page-title">My Account<span>Order Details</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('home.user.sidebar')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="card-body">
                                <div class="form-group">


                                    <label>Order Id : {{ $get_order_detail['id'] }}</label>

                                </div>


                                <div class="form-group">
                                    <label>Full Name : {{ $get_order_detail['first_name'] }} {{ $get_order_detail['last_name'] }}</label>

                                </div>



                                <div class="form-group">
                                    <label>Company Name : {{ $get_order_detail['company'] }}</label>

                                </div>
                                <div class="form-group">
                                    <label>Country : {{ $get_order_detail['country'] }}</label>

                                </div>
                                <div class="form-group">
                                    <label>Address : {{ $get_order_detail['address1'] }} , {{ $get_order_detail['address2'] }}</label>

                                </div>
                                <div class="form-group">
                                    <label>City/State : {{ $get_order_detail['city'] }} / {{ $get_order_detail['state'] }}</label>

                                </div>

                                <div class="form-group">
                                    <label>Pastcode : {{ $get_order_detail['pastcode'] }}</label>

                                </div>
                                <div class="form-group">
                                    <label>Phone : {{ $get_order_detail['phone'] }}</label>

                                </div>
                                <div class="form-group">
                                    <label>Email : {{ $get_order_detail['email'] }}</label>

                                </div>
                                <div class="form-group">
                                    <label>Total Amount : $ {{ $get_order_detail['amount'] }}</label>

                                </div>
                                <div class="form-group">
                                    <label>Payment Method : {{ $get_order_detail['payment_method'] }}</label>

                                </div>
                                <div class="form-group">
                                    <label>Order Status : @if ( $get_order_detail->status == 0)
                                        Pending
                                        @elseif ( $get_order_detail->status == 1)
                                        Inprogress
                                        @elseif ( $get_order_detail->status == 2)
                                        Delivered
                                        @elseif ( $get_order_detail->status == 3)
                                        Completed
                                        @elseif ( $get_order_detail->status == 4)
                                        Cancelled
                                        @endif</label>

                                </div>
                                <div class="form-group">
                                    <label>Note : {{ $get_order_detail['note'] }}</label>

                                </div>
                                <div class="form-group">
                                    <label>Created Date : {{ $get_order_detail['created_at'] }}</label>

                                </div>

                            </div>
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
                                        $getOrder = App\Models\Order::find($get_order_detail['id']);
                                        $orderItems = $getOrder->getItem;

                                    @endphp
                                        @foreach ($orderItems as $key => $detail)
                                        @php

                    // Retrieve the product image based on prodcut_id
                    $getproductimage = App\Models\Prodct_Image::where('prodcut_id', $detail->getProduct->id)->firstOrFail();

                                    @endphp
                                            <tr>
                                                <td class="text-sm">  <img src="{{ asset('storage/upload/products/' .$getproductimage->image_name) }}" style="height: 100px"></td>
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
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')



@endsection
