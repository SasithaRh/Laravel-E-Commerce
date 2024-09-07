@extends('home.layouts.app')
@section('style')
<link rel="stylesheet" href="{{ asset('assest/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
<link rel="stylesheet" href="{{ asset('assest/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
<!-- Main CSS File -->
<link rel="stylesheet" href="{{ asset('assest/assets/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('assest/assets/css/plugins/nouislider/nouislider.css')}}">
    @endsection
@section('content')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ $getproductsingle->getCategory->slug }}">{{ $getproductsingle->getCategory->name }}</a></li>
                <li class="breadcrumb-item" ><a href="{{  $getproductsingle->getCategory->slug.'/'.$getproductsingle->getSubCategory->slug }}">{{ $getproductsingle->getSubCategory->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $getproductsingle->title }}</li>

            </ol>

            <nav class="product-pager ml-auto" aria-label="Product">
                <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                    <i class="icon-angle-left"></i>
                    <span>Prev</span>
                </a>

                <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                    <span>Next</span>
                    <i class="icon-angle-right"></i>
                </a>
            </nav><!-- End .pager-nav -->
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                @php
                                $getproductimage = $getproductsingle->getImageSingle($getproductsingle->id);
                                //$getallproductimage = $product->getAllImage($product->id);

                            @endphp
                                <img id="product-zoom" src="{{ asset('storage/upload/products/' . $getproductimage->image_name) }}" data-zoom-image="{{ asset('storage/upload/products/' . $getproductimage->image_name) }}" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach ($getproductsingle->getImage as $Image )
                                <a class="product-gallery-item" href="#" data-image="{{ asset('storage/upload/products/' . $Image->image_name) }}" data-zoom-image="{{ asset('storage/upload/products/' . $Image->image_name) }}">
                                    <img src="{{ asset('storage/upload/products/' . $Image->image_name) }}" alt="product side" >
                                </a>
                                @endforeach



                            </div><!-- End .product-image-gallery -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $getproductsingle->title }}</h1><!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                            </div><!-- End .rating-container -->

                            <div class="product-price newPrice">
                                $ {{number_format($getproductsingle->price,2) }}
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p> {!! $getproductsingle->short_description  !!}</p>
                            </div><!-- End .product-content -->
                            <form action="{{ route('prodcut/add-to-cart') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $getproductsingle->id }}">
                            <div class="details-filter-row details-row-size">
                                <label>Color:</label>

                                <div class="product-nav product-nav-dots">
                                    <select name="color_id" id="color_id" required class="form-control">

                                    @foreach ($getproductsingle->getColor as $color )
                                        <option  value="{{ $color->getColor->id }}">{{ $color->getColor->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                   </div><!-- End .product-nav -->
                            </div><!-- End .details-filter-row -->

                            <div class="details-filter-row details-row-size">
                                <label for="size">Size:</label>
                                <div class="select-custom">
                                    <select name="size_id" id="size" class="form-control getSizePrice">

                                        <option  data-price="0" value="" selected="selected">Select a size</option>
                                        @foreach ($getproductsingle->getSize as $Size )
                                        <option data-price="{{ !empty($Size->price)?$Size->price :'' }}" value="{{ $Size->id }}">{{ $Size->name }} @if (!empty( $Size->price))
                                            ({{number_format($Size->price,2) }})
                                        @endif</option>
                                        @endforeach

                                    </select>
                                </div><!-- End .select-custom -->

                                <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                            </div><!-- End .details-filter-row -->

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1" name="qty"max="10" step="1" data-decimals="0" required>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->

                            <div class="product-details-action">
                                <button type="submit" class="btn-product btn-cart">add to cart  </button>

                                <div class="details-action-wrapper">
                                    @if (!empty(Auth::check()))

                                    <a href="javascript:;" class="btn-product btn-wishlists btn-wishlist add-to-wishlist{{$getproductsingle->id}} {{ !empty($getproductsingle->checkWishlist($getproductsingle->id))?'btn-wishlist-add':'' }} " id="{{$getproductsingle->id  }}" title="Wishlist"><span>Add to Wishlist</span></a>
                                    @else
                                    <a  href="#signin-modal" data-toggle="modal" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                    @endif
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->
                        </form>
                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                   <a href="{{ $getproductsingle->getCategory->slug }}">{{ $getproductsingle->getCategory->name }}</a>,
                <a href="{{  $getproductsingle->getCategory->slug.'/'.$getproductsingle->getSubCategory->slug }}">{{ $getproductsingle->getSubCategory->name }}</a>,
                {{ $getproductsingle->title }}

                                </div><!-- End .product-cat -->

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
        </div><!-- End .container -->

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                    </li>
                </ul>
            </div><!-- End .container -->

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <div class="container">
                            {!! $getproductsingle->description !!}
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <div class="container">
                           {!! $getproductsingle->additional_information !!}
                        </div><!-- End .container -->
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <div class="container">
                            {!! $getproductsingle->shipping_return !!}
                        </div>
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    <div class="reviews">
                        <div class="container">
                            <h3>Reviews (2)</h3>
                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">Samanta J.</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">6 days ago</span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>Good, perfect size</h4>

                                        <div class="review-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->

                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">John Doe</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">5 days ago</span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>Very good</h4>

                                        <div class="review-content">
                                            <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->
                        </div><!-- End .container -->
                    </div><!-- End .reviews -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-details-tab -->

        <div class="container">
            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>
                @foreach ($getRelatedProduct as $RelatedProduct )
                <div class="product product-7">
                    <figure class="product-media">
                        <span class="product-label label-new">New</span>
                        @php
                        $getproductimages = $RelatedProduct->getImageSingle($RelatedProduct->id);

                        @endphp

                        <a href="{{ url($RelatedProduct->slug) }}">
                            <img src="{{ asset('storage/upload/products/' . $getproductimages->image_name) }}" alt="Product image" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            @if (!empty(Auth::check()))

                            <a href="javascript:;" class="btn-product-icon btn-wishlists btn-wishlist btn-expandable add-to-wishlist{{$getproductsingle->id}} {{ !empty($getproductsingle->checkWishlist($getproductsingle->id))?'btn-wishlist-add':'' }} " id="{{$getproductsingle->id  }}" ><span>Add to Wishlist</span></a>
                            @else
                            <a  href="#signin-modal" data-toggle="modal" class="btn-product-icon btn-wishlist btn-expandable" ><span>Add to Wishlist</span></a>
                            @endif

                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="#">Women</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="{{ url($RelatedProduct->slug) }}">{{  $RelatedProduct->title}} <br>pencil skirt</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            ${{  $RelatedProduct->price}}
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 2 Reviews )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" class="active" style="background: #cc9966;"><span class="sr-only">Color name</span></a>
                            <a href="#" style="background: #7fc5ed;"><span class="sr-only">Color name</span></a>
                            <a href="#" style="background: #e8c97a;"><span class="sr-only">Color name</span></a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
                @endforeach



            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

        @section('script')

        <script src="{{ asset('assest/assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{ asset('assest/assets/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{ asset('assest/assets/js/jquery.elevateZoom.min.js')}}"></script>
        <script src="{{ asset('assest/assets/js/bootstrap-input-spinner.js')}}"></script>
        <script>
               $('.getSizePrice').change(function (e) {
                e.preventDefault();
                var productPrice ='{{$getproductsingle->price}}';
                var price =$('option:selected',this).attr('data-price');
                var total = parseFloat(productPrice) + parseFloat(price);
                $('.newPrice').html('$'+' '+total.toFixed(2));
               });
                </script>


        @endsection
