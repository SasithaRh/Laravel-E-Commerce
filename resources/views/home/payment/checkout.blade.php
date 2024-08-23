
@extends('home.layouts.app')
@section('style')

    @endsection
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url({{ asset('assest/assets/images/page-header-bg.jpg')}})">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">

                <form action="{{ route('checkout/place_order') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name *</label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Last Name *</label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Company Name (Optional)</label>
                                <input type="text" name="company" class="form-control">

                                <label>Country *</label>
                                <input type="text" name="country" class="form-control" required>

                                <label>Street address *</label>
                                <input type="text" name="address1" class="form-control" placeholder="House number and Street name" required>
                                <input type="text" name="address2" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City *</label>
                                        <input type="text" name="city" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>State *</label>
                                        <input type="text" name="state" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Postcode / ZIP *</label>
                                        <input type="text" name="pastcode" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="tel" name="phone" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Email address *</label>
                                <input type="email" name="email" class="form-control" required>
                                <input type="hidden" class="form-control" value="{{ number_format(Cart::getTotal(),2) }}" name="amount">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                                    <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                                </div><!-- End .custom-checkbox -->



                                <label>Order notes (optional)</label>
                                <textarea class="form-control" name="note" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach (Cart::getContent() as $key => $item )
                                        @php
                                            $getProduct = App\Models\Product::findOrFail($item->id);
                                            $getImage = App\Models\Prodct_Image::select('prodct__images.*')->where('prodct__images.prodcut_id', '=', $item->id)->first();
                                        @endphp
                                        <tr>
                                            <td><a href="{{ url($getProduct->slug) }}">{{ $getProduct->title }}</a></td>

                                            <td>${{ (number_format(($item->price * $item->quantity),2)) }}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>

                                            <td>${{ number_format(Cart::getTotal(),2) }}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr>
                                            <td colspan="2">
                                                <div class="cart-discount">

                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="getDiscountCode" placeholder="Discount Code">
                                                        <div class="input-group-append">
                                                            <button id="ApplyDiscount" class="btn btn-outline-primary-2" style=" height: 40px;" type="button"><i class="icon-long-arrow-right"></i></button>
                                                        </div><!-- .End .input-group-append -->
                                                    </div><!-- End .input-group -->

                                            </div><!-- End .cart-discount -->
                                            </td>

                                        </tr>
                                        <tr class="summary-subtotal">
                                            <td>Discount:</td>

                                            <td>${{ number_format(Cart::getTotal(),2) }}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr>
                                            <td>Shipping:</td>

                                            <td>Free shipping</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>

                                            <td>${{ number_format(Cart::getTotal(),2) }}</td>

                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->

                                <div class="accordion-summary" id="accordion-payment">


                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="cod"  name="payment_method" id="" >
                                       <label for="" class="cutom-control-label">Cash on delivery</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="paypal" name="payment_method" id="" >
                                       <label for="" class="cutom-control-label">PayPal</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="credit_card" name="payment_method" id="" >
                                       <label for="" class="cutom-control-label">Credit Card (Stripe)</label>
                                       <img src="{{ asset('assest/assets/images/payments-summary.png')}}" alt="payments cards">

                                    </div>



                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection

        @section('script')

        <script>
            $('#ApplyDiscount').click(function (e) {
            e.preventDefault();
            var discount_code  = $('#getDiscountCode').val();


             xhr = $.ajax({
            type: "POST",
            url: "{{ url('checkout/apply_discount') }}",
            data: {
                "_token":"{{ csrf_token() }}",
                "discount_code":discount_code,
            },
            dataType: "json",
            success: function(data) {

            },
            error: function(data) {

            }
        })
    })
        </script>

        @endsection
