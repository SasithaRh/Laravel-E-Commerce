@extends('home.layouts.app')
@section('style')

@endsection
@section('content')
<main class="main">
    <div class="page-header text-center"
        style="background-image: url({{ asset('assest/assets/images/page-header-bg.jpg')}})">
        <div class="container">
            <h1 class="page-title">My Account<span>Orders</span></h1>
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="font-weight: 800">Order Number</th>

                                        <th class="text-center " style="font-weight: 800">Email</th>
                                        <th style="font-weight: 800">Total Amount</th>
                                        <th class="text-center" style="font-weight: 800">Pay Method</th>
                                        <th style="font-weight: 800" class="text-center">Status</th>
                                        <th style="font-weight: 800" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($get_orders as $key => $detail)
                                    <tr>
                                        <td style="font-weight: 800" class="text-center">{{ $detail['id'] }}</td>

                                        <td  class="text-sm">{{ $detail['email'] }}</td>
                                        <td class="text-sm">$ {{ $detail['amount'] }}</td>
                                        <td class="text-sm" class="text-center" align="center">{{
                                            $detail['payment_method'] }}</td>
                                        <td class="text-sm" class="text-center" align="center">
                                            @if ( $detail->status == 0)
                                            Pending
                                            @elseif ( $detail->status == 1)
                                            Inprogress
                                            @elseif ( $detail->status == 2)
                                            Delivered
                                            @elseif ( $detail->status == 3)
                                            Completed
                                            @elseif ( $detail->status == 4)
                                            Cancelled
                                            @endif

                                        </td>

                                        <td><a href="{{ route('details.users.order', $detail['id']) }}"
                                                class="btn btn-primary btn-sm mr-1">Details</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{-- <div class="d-flex justify-content-center" style="margin-top: 20px;">
                                {{ $get_orders->links() }}
                            </div> --}}
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
