@extends('home.layouts.app')
@section('style')
<style>
    .box-btn{
        transition: transform  1s;
        padding: 10px;text-align: center;border-radius: 5px;box-shadow: 0 0 1px rgba(0,0,0, .125),0 1px 3px rgba(0,0,0, .2);
    }
    .box-btn:hover{
        transform: scale(1.2) ;


    }
</style>
    @endsection
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url({{ asset('assest/assets/images/page-header-bg.jpg')}})">
        <div class="container">
            <h1 class="page-title">My Account<span>Dashboard</span></h1>
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

                    <div class="col-md-10">
                        <div class="tab-content">
                            <div class="row mb-5">
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 22px;font-weight:bold;">{{ $total_orders }}</div>
                                        <div  style="font-size: 15px;">Total Orders</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 22px;font-weight:bold;">{{ $today_orders }}</div>
                                        <div  style="font-size: 15px;">Today Orders</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 22px;font-weight:bold;">$ {{ $total_payements }}</div>
                                        <div  style="font-size: 15px;">Total Amount</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 22px;font-weight:bold;">$ {{ $today_payements }}</div>
                                        <div  style="font-size: 15px;">Today Amount</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 22px;font-weight:bold;">{{ $pending_orders }}</div>
                                        <div  style="font-size: 15px;">Pending Orders</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 22px;font-weight:bold;">{{ $progress_orders }}</div>
                                        <div  style="font-size: 15px;">In Progress Orders</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 22px;font-weight:bold;">{{ $complete_orders }}</div>
                                        <div  style="font-size: 15px;">Complete Orders</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-btn">
                                        <div style="font-size: 22px;font-weight:bold;">{{ $cancelled_orders }}</div>
                                        <div  style="font-size: 15px;">Cancelled Orders</div>
                                    </div>
                                </div>
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
