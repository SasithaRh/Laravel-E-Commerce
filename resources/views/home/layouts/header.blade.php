<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    <a href="#">Usd</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">Eur</a></li>
                            <li><a href="#">Usd</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->

                <div class="header-dropdown">
                    <a href="#">Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropdown -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                            @if (!empty(Auth::check()))
                            @php

                            // Retrieve the product image based on prodcut_id
                            $checkWishlistcount = App\Models\Product_wishlist::where('user_id','=',Auth::user()->id)->count();

                                            @endphp
                            <li><a href="{{ route('my-wishlist') }}"><i class="icon-heart-o"></i>My Wishlist <span>({{ $checkWishlistcount }})</span></a></li>
                            @endif
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            @if (!empty(Auth::check()))
                            <li><a href="{{ route('user/dashboard') }}">{{ Auth::user()->name }}</a></li>
                                @else
                                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>

                            @endif
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('assest/assets/images/logo.png')}}" alt="Molla Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class=" active">
                            <a href="{{ route('home') }}" >Home</a>


                        </li>
                        <li>
                            <a href="javascript:;" class="sf-with-ul">Shop</a>

                            <div class="megamenu megamenu-md">
                                <div class="row no-gutters">
                                    <div class="col-md-8">
                                        <div class="menu-col">
                                            <div class="row">
                                                @php
                                                    $getMainCategory = App\Models\Category::getRecordMenu();
                                                @endphp

                                                @foreach ($getMainCategory as $key => $detail)
                                                @if (!empty($detail->getSubCategory->count()))
                                                <div class="col-md-4">
                                                    <a href="{{ url($detail->slug) }}">{{  $detail->name }}</a><!-- End .menu-title -->
                                                    <ul>
                                                        @foreach ( $detail->getSubCategory as $subcategory )
                                                        <li><a href="{{ url($detail->slug.'/'.$subcategory->slug) }}">{{ $subcategory->name }}</a></li>
                                                        @endforeach


                                                    </ul>


                                                </div><!-- End .col-md-6 -->
                                                @endif
                                                @endforeach



                                            </div><!-- End .row -->
                                        </div><!-- End .menu-col -->
                                    </div><!-- End .col-md-8 -->

                                    <div class="col-md-4">
                                        <div class="banner banner-overlay">
                                            <a href="category.html" class="banner banner-menu">
                                                <img src="{{ asset('assest/assets/images/menu/banner-1.jpg')}}" alt="Banner">

                                                <div class="banner-content banner-content-top">
                                                    <div class="banner-title text-white">Last <br>Chance<br><span><strong>Sale</strong></span></div><!-- End .banner-title -->
                                                </div><!-- End .banner-content -->
                                            </a>
                                        </div><!-- End .banner banner-overlay -->
                                    </div><!-- End .col-md-4 -->
                                </div><!-- End .row -->
                            </div><!-- End .megamenu megamenu-md -->
                        </li>


                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="{{ url('search') }}" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        @php
                            $cartCollection = Cart::getContent();

                        @endphp
                        @if ($cartCollection->count() > 0)
                        <span class="cart-count">{{  $cartCollection->count(); }}</span>
                        @endif

                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                          @foreach (Cart::getContent() as $item )
                          @php
                              $getProduct = App\Models\Product::findOrFail($item->id);
                              $getImage = App\Models\Prodct_Image::select('prodct__images.*')->where('prodct__images.prodcut_id', '=', $item->id)->first();
                          @endphp
                          <div class="product">
                            <div class="product-cart-details">
                                <h4 class="product-title">
                                    <a href="{{ url($getProduct->slug) }}">{{ $getProduct->title }}</a>
                                </h4>

                                <span class="cart-product-info">
                                    <span class="cart-product-qty">{{ $item->quantity }}</span>
                                    x ${{ number_format($item->price,2) }}
                                </span>
                            </div><!-- End .product-cart-details -->

                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('storage/upload/products/' . $getImage->image_name) }}" alt="product">
                                </a>
                            </figure>
                            <a href="{{ route('cart.delete',$item->id) }}" class="btn-remove"><i class="icon-close"></i></a>
                        </div><!-- End .product -->

                          @endforeach


                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">${{ number_format(Cart::getTotal(),2) }}</span>
                        </div><!-- End .dropdown-cart-total -->

                        <div class="dropdown-cart-action">
                            <a href="{{ route('cart') }}" class="btn btn-primary">View Cart</a>
                            <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .dropdown-cart-total -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->
