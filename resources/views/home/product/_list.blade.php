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
                        {{-- <a href="{{ url($getCategory->slug) }}">{{ $getCategory->name }}</a> --}}
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





    </div><!-- End .row -->
    <div class="d-flex justify-content-center" style="margin-top: 20px;">
        {{ $getproducts->links() }}
    </div>
</div><!-- End .products -->
