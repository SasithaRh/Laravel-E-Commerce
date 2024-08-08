@extends('home.layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('assest/assets/css/plugins/nouislider/nouislider.css')}}">
    @endsection
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url({{ asset('assest/assets/images/page-header-bg.jpg')}})">
        <div class="container">
            @if(!empty($getsubcategory))
             <h1 class="page-title">{{ $getsubcategory->name }}<span>Shop</span></h1>
             @else
             <h1 class="page-title">{{ $getCategory->name }}<span>Shop</span></h1>
             @endif
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url($getCategory->slug) }}">{{ $getCategory->name }}</a> </li>
                @if(!empty($getsubcategory))
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
                                Showing <span>9 of 56</span> Products
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                        <option value="popularity" selected="selected">Most Popular</option>
                                        <option value="rating">Most Rated</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->

                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row justify-content-center">
                            @foreach ($getproducts as $product)
                            @php
                                $getproductimage = $product->getImageSingle($product->id);
                                //$getallproductimage = $product->getAllImage($product->id);

                            @endphp
                            <div class="col-6 col-md-4 col-lg-4">
                                <div class="product product-7 text-center">
                                    <figure class="product-media">
                                        <span class="product-label label-new">New</span>
                                        <a href="product.html">
                                            @if (!empty( $getproductimage->image_name))
                                            <img src="{{ asset('storage/upload/products/' . $getproductimage->image_name) }}" alt="Product image"  style="width: 280px !important;
                                            height: 280px;" >

                                            @endif
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                        </div><!-- End .product-action-vertical -->

                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="{{ url($getCategory->slug) }}">{{ $getCategory->name }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ url($product->slug) }}">{{ $product->title }}</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                           ${{$product->price}}
                                        </div><!-- End .product-price -->
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">( 2 Reviews )</span>
                                        </div><!-- End .rating-container -->

                                        <div class="product-nav product-nav-thumbs">
                                            {{-- @if (!empty( $getallproductimage))
                                            @foreach ( $getallproductimage as $allimage)
                                                <p>{{ $allimage->image_name }}</p>
                                            @endforeach --}}
                                            <a href="#" class="active">
                                                <img src="{{ asset('assest/assets/images/products/product-4-thumb.jpg')}}" alt="product desc">
                                            </a>
                                            {{-- @endif --}}
                                            <a href="#">
                                                <img src="{{ asset('assest/assets/images/products/product-4-2-thumb.jpg')}}" alt="product desc">
                                            </a>

                                            <a href="#">
                                                <img src="{{ asset('assest/assets/images/products/product-4-3-thumb.jpg')}}" alt="product desc">
                                            </a>
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-lg-4 -->
                            @endforeach

                            <div class="d-flex justify-content-center" style="margin-top: 20px;">
                                {{ $getproducts->links() }}
                            </div>



                        </div><!-- End .row -->
                    </div><!-- End .products -->

                    <nav aria-label="Page navigation">
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
                    </nav>
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>Filters:</label>
                            <a href="#" class="sidebar-filter-clear">Clean All</a>
                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    Category
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">
                                        @foreach ($getsubcategoryfilter as  $f_category)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{ $f_category->id }}">
                                                <label class="custom-control-label" for="{{ $f_category->id }}">{{ $f_category->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">3</span>
                                        </div><!-- End .filter-item -->
                                        @endforeach



                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

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
                                        <a href="#" style="background: {{ $color->code }}"><span class="sr-only">{{ $color->name }}</span></a>

                                        @endforeach
                                     </div><!-- End .filter-colors -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                    Brand
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-4">
                                <div class="widget-body">
                                    <div class="filter-items">
                                        @foreach ($getbrands as $brand)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-{{ $brand->id }}">
                                                <label class="custom-control-label" for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                        @endforeach



                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

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
        @endsection




