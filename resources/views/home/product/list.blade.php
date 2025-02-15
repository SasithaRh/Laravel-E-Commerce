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
            @if(!empty($getsubcategory))
             <h1 class="page-title">{{ $getsubcategory->name }}<span>Shop</span></h1>
             @elseif (!empty($getCategory))
             <h1 class="page-title">{{ $getCategory->name }}<span>Shop</span></h1>
             @else
             <h1 class="page-title">Search : {{ Request::get('q') }}<span>Shop</span></h1>
             @endif
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
                @if(!empty($getCategory))
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url($getCategory->slug) }}">{{ $getCategory->name }}</a> </li>

                @elseif(!empty($getsubcategory))
                <li class="breadcrumb-item active" aria-current="page">{{ $getsubcategory->name }}</li>

                 @endif


            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Showing <span>{{ $getproducts->perPage() }} of {{ $getproducts->total() }}</span> Products
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control changesortby">
                                        <option value="" selected="selected">Select</option>
                                        <option value="popularity" >Most Popular</option>
                                        <option value="rating">Most Rated</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->

                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->
                    <div id="getproductajax">
                    @include('home.product._list');
                   </div>
                   <div class="text-center">
                   <a href="javascript:;" data-page="{{ $page }}" @if(empty($page)) style="display:none" @endif class="btn btn-primary LoadMore" >Load More</a>
                </div>
                    {{-- <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item-total">of 6</li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav> --}}
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <form action="" method="post" id="filterform">
                        {{ csrf_field() }}
                        <input type="hidden" name="q" value="{{!empty(Request::get('q')) ? Request::get('q') : ''}}" >
                        <input type="hidden" name="old_subcategory_id" value="{{ !empty($getsubcategory) ? $getsubcategory->id : '' }}" >
                        <input type="hidden" name="old_category_id" value="{{!empty($getCategory) ? $getCategory->id : ''}}" >
                        <input type="hidden" name="old_subcategory_id" value="{{ !empty($getsubcategory) ? $getsubcategory->id : '' }}" >
                        <input type="hidden" name="sub_category_id" id="get_sub_category_id">
                        <input type="hidden" name="brand_id" id="get_brand_id">
                        <input type="hidden" name="color_id" id="get_color_id">
                        <input type="hidden" name="sort_id" id="get_sort_by">
                        <input type="hidden" name="start_price" id="get_start_price">
                        <input type="hidden" name="end_price" id="get_end_price">
                    </form>
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>Filters:</label>
                            <a href="#" class="sidebar-filter-clear">Clean All</a>
                        </div><!-- End .widget widget-clean -->
                        @if (!empty($getsubcategoryfilter))
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    Sub Category
                                </a>
                            </h3><!-- End .widget-title -->



                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">

                                        @foreach ($getsubcategoryfilter as  $f_category)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input changeCategory" value="{{$f_category->id}}" id="{{ $f_category->id }}">
                                                <label class="custom-control-label" for="{{ $f_category->id }}">{{ $f_category->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">{{ $f_category->totalproducts() }}</span>
                                        </div><!-- End .filter-item -->
                                        @endforeach



                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                        @endif
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                    Size
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-2">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-1">
                                                <label class="custom-control-label" for="size-1">XS</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-2">
                                                <label class="custom-control-label" for="size-2">S</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked id="size-3">
                                                <label class="custom-control-label" for="size-3">M</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" checked id="size-4">
                                                <label class="custom-control-label" for="size-4">L</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-5">
                                                <label class="custom-control-label" for="size-5">XL</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->

                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-6">
                                                <label class="custom-control-label" for="size-6">XXL</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                        @if (!empty($getcolors))
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                                    Colour
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-3">
                                <div class="widget-body">
                                    <div class="filter-colors">
                                        @foreach ($getcolors as $color )
                                        <a href="javascript:;" data-val="0" class="changecolor" id="{{ $color->id }}" style="background: {{ $color->code }}"><span class="sr-only">{{ $color->name }}</span></a>

                                        @endforeach
                                     </div><!-- End .filter-colors -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                        @endif
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                    Brand
                                </a>
                            </h3><!-- End .widget-title -->
                            @if (!empty($getbrands))
                            <div class="collapse show" id="widget-4">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        @foreach ($getbrands as $brand)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input changeBrand" value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                                <label class="custom-control-label" for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                        @endforeach



                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
@endif
                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                    Price
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-5">
                                <div class="widget-body">
                                    <div class="filter-price">
                                        <div class="filter-price-text">
                                            Price Range:
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->

                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .filter-price -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->



@endsection

        @section('script')
        <script src="{{ asset('assest/assets/js/nouislider.min.js')}}"></script>
        <script src="{{ asset('assest/assets/js/wNumb.js')}}"></script>
    <script src="{{ asset('assest/assets/js/bootstrap-input-spinner.js')}}"></script>

    <script>

            $('.changeCategory').change(function (e) {
                e.preventDefault();
                var ids ='';

            $('.changeCategory').each(function(){
                if(this.checked){
                    var id = $(this).val();
                        ids += id+',';
                }

                        });

            $('#get_sub_category_id').val(ids);
            FilterForm(ids)
            });
            $('.changeBrand').change(function (e) {
                e.preventDefault();
                var ids ='';

            $('.changeBrand').each(function(){
                if(this.checked){
                    var id = $(this).val();
                        ids += id+',';
                }

                        });

            $('#get_brand_id').val(ids);
            FilterForm()
            });

            $('.changecolor').click(function (e) {
                e.preventDefault();
                var id =$(this).attr('id');
                var status =$(this).attr('data-val');
                if(status ==0){
                    $(this).attr('data-val',1);
                    $(this).addClass("active-color");
                }else{
                    $(this).attr('data-val',0);
                    $(this).removeClass("active-color");
                }
                var ids = '';
                $('.changecolor').each(function(){
                    var status =$(this).attr('data-val');

                if(status== 1){
                    var id = $(this).attr('id');
                        ids += id+',';
                }

                        });

            $('#get_color_id').val(ids);
            FilterForm()
            });
            $('.changesortby').change(function (e) {
                e.preventDefault();
                 var id = $(this).val();

            $('#get_sort_by').val(id);
            FilterForm()
            });
var xhr;
            function FilterForm() {
                if(xhr && xhr.readyState !=4){
                    xhr.abort();
                }
             xhr = $.ajax({
            type: "POST",
            url: "{{ url('get_product_filter') }}",
            data: $('#filterform').serialize(),
            dataType: "json",
            success: function(data) {
                $('#getproductajax').html(data.success);
                $('.LoadMore').attr('data-page',data.page);
                if(data.page == 0){
                    $('.LoadMore').hide();
                }else{
                    $('.LoadMore').show();
                }
            },
            error: function(data) {

            }
        })
        };
        var i = 0;
        if ( typeof noUiSlider === 'object' ) {
		var priceSlider  = document.getElementById('price-slider');



		noUiSlider.create(priceSlider, {
			start: [ 0, 2000 ],
			connect: true,
			step: 1,
			margin: 200,
			range: {
				'min': 0,
				'max': 2000
			},
			tooltips: true,
			format: wNumb({
		        decimals: 0,
		        prefix: '$'
		    })
		});

		// Update Price Range
		priceSlider.noUiSlider.on('update', function( values, handle ){

            var start_price = values[0];
            var end_price = values[1];

			$('#get_start_price').val(start_price);
            $('#get_end_price').val(end_price);
            if(i==0 || i==1){
                i++;
            }else{FilterForm();}

		});

        $('.LoadMore').click(function (e) {
            e.preventDefault();
            var page  = $(this).attr('data-page');
            $('.LoadMore').html("Loading ...");
            if(xhr && xhr.readyState !=4){
                    xhr.abort();
                }
             xhr = $.ajax({
            type: "POST",
            url: "{{ url('get_product_filter') }}?page="+page,
            data: $('#filterform').serialize(),
            dataType: "json",
            success: function(data) {
                $('#getproductajax').append(data.success);
                $('.LoadMore').attr('data-page',data.page);
                $('.LoadMore').html("Load More");
                if(data.page == 0){
                    $('.LoadMore').hide();
                }else{
                    $('.LoadMore').show();
                }
            },
            error: function(data) {

            }
        })

        });
	}


</script>

        @endsection




