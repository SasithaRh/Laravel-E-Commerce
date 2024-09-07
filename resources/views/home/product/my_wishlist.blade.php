@extends('home.layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('assest/assets/css/plugins/nouislider/nouislider.css')}}">
<style>
   .active-color{
    border: 2px solid black !important;
   }
</style>
    @endsection
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url({{ asset('assest/assets/images/page-header-bg.jpg')}})">
        <div class="container">


             <h1 class="page-title">My Wishlist</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">My Wishlist</a></li>



            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                {{-- Showing <span>{{ $getwishlistproduct->perPage() }} of {{ $getwishlistproduct->total() }}</span> Products --}}

                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                    </div><!-- End .toolbox -->
                    <div id="getproductajax">
                    @include('home.product._list');
                   </div>


                </div><!-- End .col-lg-9 -->

            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->



@endsection

        @section('script')
        <script src="{{ asset('assest/assets/js/nouislider.min.js')}}"></script>
        <script src="{{ asset('assest/assets/js/wNumb.js')}}"></script>
    <script src="{{ asset('assest/assets/js/bootstrap-input-spinner.js')}}"></script>



        @endsection




