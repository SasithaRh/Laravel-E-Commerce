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

                    <div class="col-md-4">
                        <div class="tab-content">
                            <div class="card-body">
                                @include('home.layouts.messages')
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
                                    <label>Created Date : {{ $get_order_detail['created_at'] }}</label>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tab-content">
                            <div class="card-body">
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
                            </div>
                        </div>
                    </div>
                </div>
                            <div class="card-header">
                                <div class="col-sm-12">
                                    <h3 style="text-align: center" class="card-title">Prodcut Details</h3>
                                </div>
                                {{-- <div class="col-sm-2">
                                    <a href="{{ route('create.Order') }}" class="text-white"><button type="button"
                                            class="btn btn-block btn-primary btn-sm">Add New Order</button></a>
                                </div> --}}
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header" style="background-color: blanchedalmond">
                                  <h5 class="modal-title" id="exampleModalLabel">Make Review</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{ route('make_review') }}" method="post">
                                    @csrf
                                    <input type="hidden" id="getorderid" name="order_id">
                                    <input type="hidden" id="getproductid" name="product_id">
                                <div class="modal-body" style="padding: 20px">
                                 <div class="form-group">
                                    <label for="" class="ml-3">How many start</label>
                                    <select name="rating" id="" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    </select>
                                    <label for="" class="ml-3">Review</label>
                                    <textarea name="review" id="" cols="3" rows="3" class="form-control"></textarea>
                                 </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit"  class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                              </div>
                            </div>
                          </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th ><h6 style="margin-left: 10px">  Image</h6></th>
                                            <th> <h6> Product Name</h6></th>
                                            <th> <h6> Qty</h6></th>
                                            <th> <h6> Price</h6></th>
                                            <th> <h6> Size Name</h6></th>
                                            <th> <h6> Total Amount</h6></th>
                                            @if ($get_order_detail->status == 3)
                                            <td>
                                            </td>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $getOrder = App\Models\Order::find($get_order_detail['id']);
                                        $orderItems = $getOrder->getItem;

                                    @endphp
                                        @foreach ($orderItems as $key => $detail)
                                        @php

                    $getproductimage = App\Models\Prodct_Image::where('prodcut_id', $detail->getProduct->id)->firstOrFail();

                                    @endphp
                                            <tr>
                                                <td class="text-sm">  <img src="{{ asset('storage/upload/products/' .$getproductimage->image_name) }}" style="height: 100px"></td>
                                                <td class="text-sm"><a href="{{ url($detail->getProduct->slug) }}" target="_blank" rel="noopener noreferrer"> {{ $detail->getProduct->title}}</a></td>
                                                <td class="text-sm">{{ $detail['quantity'] }}</td>
                                                <td class="text-sm">$ {{ number_format($detail['price'],2) }}</td>
                                                <td class="text-sm">{{ $detail['size_name'] }}</td>
                                                <td class="text-sm">$ {{ $detail['total_amount'] }}</td>
                                                @if ($get_order_detail->status == 3)
                                                @php
                                                $getReview = App\Models\Order::getReview($detail->getProduct->id,$get_order_detail->id)

                                            @endphp
                                            @if (!empty($getReview))
                                            <td>
                                             <b> Review : </b> {{ $getReview->review }} <br>
                                             <b>Rating :</b>   {{ $getReview->rating }}
                                            </td>


                                                @else
                                                <td>
                                                    <button class="btn btn-primary make_review" data-toggle="modal" data-target="#exampleModal" id="{{$detail->getProduct->id }}" data-order={{ $get_order_detail->id }}>Make Review</button>
                                                  </td>
                                            @endif

                                                @endif



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

<script>
    $('.make_review').click(function (e) {
    e.preventDefault();
    var product_id  = $(this).attr('id');
    var order_id =  $(this).attr('data-order');
$('#getorderid').val(order_id);
$('#getproductid').val(product_id);
//      xhr = $.ajax({
//     type: "POST",
//     url: "{{ url('checkout/apply_discount') }}",
//     data: {
//         "_token":"{{ csrf_token() }}",
//         "discount_code":discount_code,
//     },
//     dataType: "json",
//     success: function(data) {

//     },
//     error: function(data) {

//     }
// })
})
</script>

@endsection
